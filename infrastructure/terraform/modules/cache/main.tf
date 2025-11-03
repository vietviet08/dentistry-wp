# ElastiCache Subnet Group
resource "aws_elasticache_subnet_group" "main" {
  name       = "${var.project_name}-${var.environment}-redis-subnet"
  subnet_ids = var.private_subnet_ids

  tags = merge(
    var.tags,
    {
      Name = "${var.project_name}-${var.environment}-redis-subnet"
    }
  )
}

# ElastiCache Parameter Group
resource "aws_elasticache_parameter_group" "main" {
  name   = "${var.project_name}-${var.environment}-redis-params"
  family = "redis7"

  parameter {
    name  = "maxmemory-policy"
    value = "allkeys-lru"
  }

  tags = merge(
    var.tags,
    {
      Name = "${var.project_name}-${var.environment}-redis-params"
    }
  )
}

# ElastiCache Replication Group (Redis Cluster)
resource "aws_elasticache_replication_group" "main" {
  replication_group_id       = "${var.project_name}-${var.environment}-redis"
  description                = "Redis cluster for ${var.project_name}-${var.environment}"

  engine                     = "redis"
  engine_version              = "7.1"
  port                       = 6379
  parameter_group_name        = aws_elasticache_parameter_group.main.name
  node_type                   = var.node_type
  num_cache_clusters          = var.num_cache_nodes

  subnet_group_name           = aws_elasticache_subnet_group.main.name
  security_group_ids          = [var.security_group_id]
  
  automatic_failover_enabled  = var.num_cache_nodes > 1 ? true : false
  multi_az_enabled            = var.num_cache_nodes > 1 ? true : false
  at_rest_encryption_enabled  = true
  transit_encryption_enabled   = false

  snapshot_retention_limit    = 5
  snapshot_window            = "03:00-05:00"
  
  maintenance_window          = "sun:05:00-sun:07:00"
  
  auto_minor_version_upgrade   = true

  log_delivery_configuration {
    destination      = aws_cloudwatch_log_group.redis.name
    destination_type = "cloudwatch-logs"
    log_format       = "text"
    log_type         = "slow-log"
  }

  tags = merge(
    var.tags,
    {
      Name = "${var.project_name}-${var.environment}-redis"
    }
  )
}

# CloudWatch Log Group for Redis
resource "aws_cloudwatch_log_group" "redis" {
  name              = "/aws/elasticache/redis/${var.project_name}-${var.environment}"
  retention_in_days = 7

  tags = merge(
    var.tags,
    {
      Name = "${var.project_name}-${var.environment}-redis-logs"
    }
  )
}

