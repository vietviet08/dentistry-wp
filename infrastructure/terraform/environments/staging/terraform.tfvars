region            = "ap-southeast-1"
environment       = "staging"
project_name      = "dentistry"
domain_name       = "staging.example.com" # Change this to your staging domain

vpc_cidr          = "10.1.0.0/16"
availability_zones = ["ap-southeast-1a", "ap-southeast-1b"]

# ECS Configuration
ecs_cpu           = 512
ecs_memory        = 1024
ecs_desired_count = 1
ecs_min_capacity  = 1
ecs_max_capacity  = 5

# RDS Configuration
rds_instance_class    = "db.t3.micro"
rds_allocated_storage = 20
rds_multi_az         = false

# Redis Configuration
redis_node_type     = "cache.t3.micro"
redis_num_cache_nodes = 1

# Database credentials
db_username = "dentistry_admin"
db_password = "CHANGE_ME_IN_SECRETS_MANAGER"

# Secrets Manager ARNs
secrets_arns = []

# Container environment variables
container_environment = [
  {
    name  = "APP_ENV"
    value = "staging"
  },
  {
    name  = "APP_DEBUG"
    value = "true"
  }
]

# Container secrets from Secrets Manager
container_secrets = []

# Alert emails
alert_emails = []

tags = {
  Project     = "Dentistry"
  ManagedBy   = "Terraform"
  Environment = "staging"
}

