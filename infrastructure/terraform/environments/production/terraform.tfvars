region            = "ap-southeast-1"
environment       = "production"
project_name      = "dentistry"
domain_name       = "catcosy.shop"

vpc_cidr          = "10.0.0.0/16"
availability_zones = ["ap-southeast-1a", "ap-southeast-1b"]

# ECS Configuration
ecs_cpu           = 1024
ecs_memory        = 2048
ecs_desired_count = 2
ecs_min_capacity  = 2
ecs_max_capacity  = 10

# RDS Configuration
rds_instance_class    = "db.t3.small"
rds_allocated_storage = 50
rds_multi_az         = true

# Redis Configuration
redis_node_type     = "cache.t3.small"
redis_num_cache_nodes = 1

# Database credentials (should be in Secrets Manager in production)
db_username = "dentistry_admin"
db_password = "admin@123"

# Secrets Manager ARNs (create these manually or via separate terraform)
secrets_arns = []

# Container environment variables
container_environment = [
  {
    name  = "APP_ENV"
    value = "production"
  },
  {
    name  = "APP_DEBUG"
    value = "false"
  }
]

# Container secrets from Secrets Manager
container_secrets = []

# Alert emails
alert_emails = ["vietvie203@gmail.com"]

tags = {
  Project     = "Dentistry"
  ManagedBy   = "Terraform"
  Environment = "production"
}
