# Infrastructure as Code

This directory contains Terraform configurations for deploying the Dentistry application to AWS.

## Structure

```
infrastructure/
├── terraform/
│   ├── modules/          # Reusable Terraform modules
│   ├── environments/     # Environment-specific configurations
│   └── backend.tf        # Backend configuration
└── scripts/              # Deployment and utility scripts
```

## Prerequisites

-   Terraform >= 1.0
-   AWS CLI configured with appropriate credentials
-   AWS account with necessary permissions

## Usage

### Initialize Terraform

```bash
cd infrastructure/terraform/environments/production
terraform init
```

### Plan Changes

```bash
terraform plan
```

### Apply Changes

```bash
terraform apply
```

### Destroy Infrastructure

```bash
terraform destroy
```

## Backend Configuration

The Terraform state is stored in S3 with DynamoDB for state locking. Configure the backend in `backend.tf` before running `terraform init`.

## Modules

-   **networking**: VPC, subnets, security groups, load balancers
-   **compute**: ECS cluster, task definitions, services
-   **database**: RDS PostgreSQL instance
-   **storage**: S3 buckets for application data
-   **cache**: ElastiCache Redis cluster
-   **edge**: Route53, CloudFront, WAF, ACM
-   **monitoring**: CloudWatch, SNS, alarms

## Variables

Key variables are defined in `variables.tf`. Environment-specific values are in `environments/{environment}/terraform.tfvars`.

## Secrets Management

Sensitive values are managed through AWS Secrets Manager and referenced in ECS task definitions.
