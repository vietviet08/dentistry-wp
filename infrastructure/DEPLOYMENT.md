# Deployment Guide

This guide covers the deployment process for the Dentistry application to AWS.

## Prerequisites

1. AWS Account with appropriate permissions
2. Domain name configured
3. AWS CLI installed and configured
4. Terraform >= 1.0 installed
5. Docker installed (for local testing)
6. GitHub repository with secrets configured

## Initial Setup

### 1. Configure AWS Credentials

```bash
aws configure
```

Or set environment variables:

```bash
export AWS_ACCESS_KEY_ID=your-access-key
export AWS_SECRET_ACCESS_KEY=your-secret-key
export AWS_DEFAULT_REGION=ap-southeast-1
```

### 2. Create S3 Bucket for Terraform State

```bash
aws s3 mb s3://dentistry-terraform-state --region ap-southeast-1
aws s3api put-bucket-versioning \
    --bucket dentistry-terraform-state \
    --versioning-configuration Status=Enabled

# Create DynamoDB table for state locking
aws dynamodb create-table \
    --table-name terraform-state-lock \
    --attribute-definitions AttributeName=LockID,AttributeType=S \
    --key-schema AttributeName=LockID,KeyType=HASH \
    --provisioned-throughput ReadCapacityUnits=5,WriteCapacityUnits=5 \
    --region ap-southeast-1
```

### 3. Configure Terraform Backend

Edit `infrastructure/terraform/backend.tf`:

```hcl
terraform {
  backend "s3" {
    bucket         = "dentistry-terraform-state"
    key            = "dentistry/production/terraform.tfstate"
    region         = "ap-southeast-1"
    dynamodb_table = "terraform-state-lock"
    encrypt        = true
  }
}
```

### 4. Configure Environment Variables

Edit `infrastructure/terraform/environments/production/terraform.tfvars`:

-   Update `domain_name` with your actual domain
-   Set `db_password` (or use Secrets Manager)
-   Configure `alert_emails` for notifications
-   Adjust resource sizes as needed

## Deployment Steps

### Step 1: Initialize Terraform

```bash
cd infrastructure/terraform/environments/production
terraform init
```

### Step 2: Review Plan

```bash
terraform plan
```

Review the planned changes carefully.

### Step 3: Apply Infrastructure

```bash
terraform apply
```

This will create:

-   VPC and networking components
-   RDS PostgreSQL database
-   ElastiCache Redis
-   S3 buckets
-   ECS cluster and service
-   ECR repository
-   Route53, CloudFront, WAF
-   CloudWatch alarms and SNS topics

### Step 4: Configure Secrets Manager

Create secrets in AWS Secrets Manager:

```bash
# Database credentials
aws secretsmanager create-secret \
    --name dentistry/production/database \
    --secret-string '{"username":"dentistry_admin","password":"your-secure-password","host":"rds-endpoint","port":5432,"database":"dentistry"}'

# Application key
aws secretsmanager create-secret \
    --name dentistry/production/app-key \
    --secret-string 'base64:your-app-key'

# Redis password (if using auth)
aws secretsmanager create-secret \
    --name dentistry/production/redis \
    --secret-string '{"password":"your-redis-password"}'
```

Update the Terraform variables to reference these secrets.

### Step 5: Build and Push Docker Image

```bash
# Get ECR login token
aws ecr get-login-password --region ap-southeast-1 | \
    docker login --username AWS --password-stdin \
    $(aws sts get-caller-identity --query Account --output text).dkr.ecr.ap-southeast-1.amazonaws.com

# Build image
docker build -t dentistry:latest .

# Tag and push
ECR_REPO=$(terraform output -raw ecr_repository_url)
docker tag dentistry:latest $ECR_REPO:latest
docker push $ECR_REPO:latest
```

### Step 6: Update ECS Service

```bash
CLUSTER_NAME=$(terraform output -raw ecs_cluster_name | tr -d '"')
SERVICE_NAME=$(terraform output -raw ecs_service_name | tr -d '"')

aws ecs update-service \
    --cluster $CLUSTER_NAME \
    --service $SERVICE_NAME \
    --force-new-deployment \
    --region ap-southeast-1
```

### Step 7: Run Database Migrations

Use the GitHub Actions workflow or run manually:

```bash
# Run migration task
aws ecs run-task \
    --cluster $CLUSTER_NAME \
    --task-definition $TASK_DEFINITION \
    --launch-type FARGATE \
    --network-configuration "awsvpcConfiguration={subnets=[$SUBNET_IDS],securityGroups=[$SECURITY_GROUP],assignPublicIp=DISABLED}" \
    --overrides '{
      "containerOverrides": [{
        "name": "app",
        "command": ["php", "artisan", "migrate", "--force"]
      }]
    }'
```

### Step 8: Configure DNS

Update your domain's nameservers to point to Route53:

```bash
terraform output route53_name_servers
```

Update your domain registrar with these nameservers.

## Continuous Deployment

Once initial setup is complete, deployments happen automatically via GitHub Actions:

1. Push to `main` branch triggers build
2. Docker image is built and pushed to ECR
3. Tests are run
4. ECS service is updated
5. Database migrations run (if needed)

## Manual Deployment

To manually trigger a deployment:

1. Go to GitHub Actions
2. Select "Deploy to AWS" workflow
3. Click "Run workflow"
4. Select environment (production/staging)

## Environment Variables

ECS tasks get environment variables from:

1. Task definition environment variables
2. Secrets Manager (referenced in container secrets)
3. Systems Manager Parameter Store (optional)

Key variables:

-   `APP_ENV=production`
-   `APP_DEBUG=false`
-   `APP_URL=https://your-domain.com`
-   `DB_CONNECTION=pgsql`
-   `REDIS_HOST` (from ElastiCache)
-   `AWS_BUCKET` (from S3)

## Monitoring

### CloudWatch Logs

View application logs:

```bash
aws logs tail /ecs/dentistry-production --follow
```

### CloudWatch Metrics

Monitor:

-   ECS CPU/Memory utilization
-   RDS metrics
-   ALB request counts and latency
-   CloudFront requests

### Alarms

Alarms are configured for:

-   High CPU utilization (>80%)
-   High memory utilization (>90%)
-   Database connection errors
-   5xx errors
-   Low storage space

Alarms send notifications via SNS to configured email addresses.

## Scaling

Auto-scaling is configured based on:

-   CPU utilization (target: 70%)
-   Memory utilization (target: 80%)

Adjust scaling policies in `modules/compute/main.tf` if needed.

## Backup and Recovery

### Database Backups

RDS automated backups:

-   Retention: 7 days
-   Window: 03:00-04:00 UTC
-   Multi-AZ enabled (production)

Manual snapshot:

```bash
aws rds create-db-snapshot \
    --db-instance-identifier dentistry-production-db \
    --db-snapshot-identifier dentistry-manual-$(date +%Y%m%d)
```

### S3 Backups

S3 versioning is enabled. Lifecycle policies:

-   Move to IA after 30 days
-   Move to Glacier after 90 days

## Troubleshooting

### Service Not Starting

1. Check ECS task logs in CloudWatch
2. Verify task definition configuration
3. Check security group rules
4. Verify secrets are accessible

### Database Connection Issues

1. Check security group allows connections from ECS
2. Verify database credentials in Secrets Manager
3. Check RDS endpoint and port

### High Latency

1. Check CloudWatch metrics
2. Review ALB target health
3. Check database performance
4. Review application logs

## Rollback Procedure

### Rollback ECS Service

```bash
# List previous task definitions
aws ecs list-task-definitions --family-prefix dentistry-production-app

# Update service to previous task definition
aws ecs update-service \
    --cluster $CLUSTER_NAME \
    --service $SERVICE_NAME \
    --task-definition dentistry-production-app:REVISION \
    --region ap-southeast-1
```

### Rollback Infrastructure

```bash
cd infrastructure/terraform/environments/production
terraform plan -out=plan.out
# Review plan
terraform apply plan.out
```

## Security Considerations

1. Never commit secrets to repository
2. Use Secrets Manager for sensitive data
3. Enable encryption at rest for RDS and S3
4. Use IAM roles with least privilege
5. Enable WAF rules
6. Use HTTPS only (configured in CloudFront)

## Cost Optimization

1. Use appropriate instance sizes
2. Enable auto-scaling to scale down during low traffic
3. Use S3 lifecycle policies
4. Review CloudWatch log retention
5. Use reserved instances for RDS (production)

## Maintenance Windows

-   Database: Sunday 04:00-05:00 UTC
-   Redis: Sunday 05:00-07:00 UTC
-   ECS: Rolling deployments (no downtime)

## Support

For issues:

1. Check CloudWatch logs
2. Review GitHub Actions logs
3. Check Terraform state
4. Contact infrastructure team
