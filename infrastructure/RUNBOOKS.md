# Operational Runbooks

Common operational procedures for the Dentistry application infrastructure.

## Service Health Checks

### Check Application Health

```bash
# Get ALB DNS name
ALB_DNS=$(aws elbv2 describe-load-balancers \
    --names dentistry-production-alb \
    --query 'LoadBalancers[0].DNSName' \
    --output text)

# Check health endpoint
curl -f https://$ALB_DNS/health
```

### Check ECS Service Status

```bash
CLUSTER_NAME="dentistry-production-cluster"
SERVICE_NAME="dentistry-production-service"

aws ecs describe-services \
    --cluster $CLUSTER_NAME \
    --services $SERVICE_NAME \
    --query 'services[0].[status,runningCount,desiredCount]' \
    --output table
```

### Check RDS Status

```bash
aws rds describe-db-instances \
    --db-instance-identifier dentistry-production-db \
    --query 'DBInstances[0].[DBInstanceStatus,DBInstanceClass,MultiAZ]' \
    --output table
```

### Check Redis Status

```bash
aws elasticache describe-replication-groups \
    --replication-group-id dentistry-production-redis \
    --query 'ReplicationGroups[0].[Status,NodeGroups[0].NodeGroupMembers[0].CurrentRole]' \
    --output table
```

## Common Issues and Solutions

### Issue: ECS Tasks Failing to Start

**Symptoms:**

-   Service desired count not matching running count
-   Tasks stuck in PENDING state

**Troubleshooting:**

1. Check task logs:

```bash
aws logs tail /ecs/dentistry-production --follow
```

2. Check task status:

```bash
TASK_ARN=$(aws ecs list-tasks \
    --cluster $CLUSTER_NAME \
    --service-name $SERVICE_NAME \
    --query 'taskArns[0]' \
    --output text)

aws ecs describe-tasks \
    --cluster $CLUSTER_NAME \
    --tasks $TASK_ARN
```

3. Common causes:
    - Missing or incorrect secrets
    - Security group blocking traffic
    - Insufficient CPU/memory
    - Image pull failures

**Solution:**

-   Verify secrets in Secrets Manager
-   Check security group rules
-   Review task definition resource limits
-   Verify ECR image exists and is accessible

### Issue: Database Connection Errors

**Symptoms:**

-   Application logs show connection timeouts
-   Health checks failing

**Troubleshooting:**

1. Verify security group rules:

```bash
SG_ID=$(aws rds describe-db-instances \
    --db-instance-identifier dentistry-production-db \
    --query 'DBInstances[0].VpcSecurityGroups[0].VpcSecurityGroupId' \
    --output text)

aws ec2 describe-security-groups \
    --group-ids $SG_ID \
    --query 'SecurityGroups[0].IpPermissions'
```

2. Test connection from ECS task:

```bash
# Run a test task
aws ecs run-task \
    --cluster $CLUSTER_NAME \
    --task-definition $TASK_DEFINITION \
    --launch-type FARGATE \
    --overrides '{
      "containerOverrides": [{
        "name": "app",
        "command": ["php", "-r", "echo phpinfo();"]
      }]
    }'
```

**Solution:**

-   Ensure RDS security group allows connections from ECS security group on port 5432
-   Verify database credentials in Secrets Manager
-   Check RDS endpoint and port

### Issue: High Memory Usage

**Symptoms:**

-   CloudWatch alarms triggering
-   Tasks being killed
-   Service unstable

**Troubleshooting:**

1. Check current memory usage:

```bash
aws cloudwatch get-metric-statistics \
    --namespace AWS/ECS \
    --metric-name MemoryUtilization \
    --dimensions Name=ServiceName,Value=$SERVICE_NAME \
                 Name=ClusterName,Value=$CLUSTER_NAME \
    --start-time $(date -u -d '1 hour ago' +%Y-%m-%dT%H:%M:%S) \
    --end-time $(date -u +%Y-%m-%dT%H:%M:%S) \
    --period 300 \
    --statistics Average \
    --output table
```

2. Review application logs for memory leaks
3. Check OPcache configuration

**Solution:**

-   Increase task memory allocation
-   Review and optimize application code
-   Check for memory leaks
-   Adjust OPcache settings

### Issue: Slow Response Times

**Symptoms:**

-   High latency in CloudWatch
-   User complaints

**Troubleshooting:**

1. Check ALB metrics:

```bash
aws cloudwatch get-metric-statistics \
    --namespace AWS/ApplicationELB \
    --metric-name TargetResponseTime \
    --dimensions Name=LoadBalancer,Value=$ALB_ARN \
    --start-time $(date -u -d '1 hour ago' +%Y-%m-%dT%H:%M:%S) \
    --end-time $(date -u +%Y-%m-%dT%H:%M:%S) \
    --period 300 \
    --statistics Average \
    --output table
```

2. Check database query performance
3. Review Redis cache hit rates
4. Check CloudFront cache statistics

**Solution:**

-   Scale up ECS tasks
-   Optimize database queries
-   Review cache configuration
-   Check CloudFront cache policies

## Scaling Procedures

### Manual Scale Up

```bash
aws application-autoscaling register-scalable-target \
    --service-namespace ecs \
    --resource-id service/$CLUSTER_NAME/$SERVICE_NAME \
    --scalable-dimension ecs:service:DesiredCount \
    --min-capacity 5 \
    --max-capacity 20
```

### Manual Scale Down

```bash
aws ecs update-service \
    --cluster $CLUSTER_NAME \
    --service $SERVICE_NAME \
    --desired-count 2 \
    --region ap-southeast-1
```

## Maintenance Windows

### Database Maintenance

1. Create manual snapshot before maintenance
2. Schedule maintenance window
3. Monitor during maintenance
4. Verify after completion

```bash
# Create snapshot
aws rds create-db-snapshot \
    --db-instance-identifier dentistry-production-db \
    --db-snapshot-identifier pre-maintenance-$(date +%Y%m%d-%H%M%S)
```

### Application Updates

1. Build and test new image
2. Push to ECR
3. Update ECS service (rolling deployment)
4. Monitor health checks
5. Rollback if needed

## Backup and Recovery

### Create Manual Database Snapshot

```bash
aws rds create-db-snapshot \
    --db-instance-identifier dentistry-production-db \
    --db-snapshot-identifier manual-$(date +%Y%m%d-%H%M%S)
```

### Restore from Snapshot

```bash
# List snapshots
aws rds describe-db-snapshots \
    --db-snapshot-identifier your-snapshot-id

# Restore (creates new instance)
aws rds restore-db-instance-from-db-snapshot \
    --db-instance-identifier dentistry-restored-db \
    --db-snapshot-identifier your-snapshot-id \
    --db-instance-class db.t3.medium
```

### S3 Backup Verification

```bash
# List bucket versions
aws s3api list-object-versions \
    --bucket dentistry-production-storage \
    --prefix storage/app/public \
    --max-items 10
```

## Log Management

### View Recent Logs

```bash
aws logs tail /ecs/dentistry-production --since 1h --follow
```

### Search Logs

```bash
aws logs filter-log-events \
    --log-group-name /ecs/dentistry-production \
    --filter-pattern "ERROR" \
    --start-time $(date -d '1 hour ago' +%s)000
```

### Export Logs

```bash
aws logs create-export-task \
    --log-group-name /ecs/dentistry-production \
    --from $(date -d '1 day ago' +%s)000 \
    --to $(date +%s)000 \
    --destination dentistry-log-exports \
    --destination-prefix logs-$(date +%Y%m%d)
```

## Security Incidents

### Revoke IAM Access

```bash
# Detach policy from user
aws iam detach-user-policy \
    --user-name compromised-user \
    --policy-arn arn:aws:iam::ACCOUNT:policy/PolicyName
```

### Rotate Secrets

```bash
# Generate new secret
NEW_PASSWORD=$(openssl rand -base64 32)

# Update in Secrets Manager
aws secretsmanager update-secret \
    --secret-id dentistry/production/database \
    --secret-string "{\"password\":\"$NEW_PASSWORD\"}"
```

### Review Security Groups

```bash
# List security group rules
aws ec2 describe-security-groups \
    --filters "Name=tag:Name,Values=*dentistry-production*" \
    --query 'SecurityGroups[*].[GroupId,GroupName,IpPermissions]'
```

## Performance Tuning

### Database Performance

1. Review slow query log
2. Check connection pool usage
3. Review index usage
4. Consider read replicas for heavy read workloads

### Application Performance

1. Enable OPcache (already configured)
2. Review cache hit rates
3. Optimize asset delivery via CloudFront
4. Review queue processing

### Cache Optimization

```bash
# Check Redis memory usage
aws cloudwatch get-metric-statistics \
    --namespace AWS/ElastiCache \
    --metric-name DatabaseMemoryUsagePercentage \
    --dimensions Name=ReplicationGroupId,Value=dentistry-production-redis \
    --start-time $(date -u -d '1 hour ago' +%Y-%m-%dT%H:%M:%S) \
    --end-time $(date -u +%Y-%m-%dT%H:%M:%S) \
    --period 300 \
    --statistics Average
```

## Disaster Recovery

### Full System Recovery

1. Restore database from latest snapshot
2. Restore S3 data from versioning
3. Redeploy application from ECR
4. Update DNS records
5. Verify all services

### Partial Recovery

1. Identify affected components
2. Restore from backups
3. Redeploy affected services
4. Verify functionality

## Communication

During incidents:

1. Update status page/dashboard
2. Notify stakeholders via SNS
3. Document timeline in incident log
4. Post-mortem after resolution
