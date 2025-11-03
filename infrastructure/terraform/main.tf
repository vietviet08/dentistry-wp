# Provider Configuration
provider "aws" {
  region = var.region

  default_tags {
    tags = merge(
      var.tags,
      {
        Environment = var.environment
      }
    )
  }
}

# Networking Module
module "networking" {
  source = "./modules/networking"

  project_name      = var.project_name
  environment       = var.environment
  vpc_cidr          = var.vpc_cidr
  availability_zones = var.availability_zones
  tags              = var.tags
}

# Storage Module
module "storage" {
  source = "./modules/storage"

  project_name                = var.project_name
  environment                 = var.environment
  cloudfront_distribution_arn = module.edge.cloudfront_distribution_arn
  allowed_cors_origins        = ["https://${var.domain_name}"]
  tags                        = var.tags
}

# Database Module
module "database" {
  source = "./modules/database"

  project_name         = var.project_name
  environment          = var.environment
  database_subnet_ids  = module.networking.database_subnet_ids
  security_group_id    = module.networking.rds_security_group_id
  instance_class       = var.rds_instance_class
  allocated_storage    = var.rds_allocated_storage
  multi_az             = var.rds_multi_az
  db_username          = var.db_username
  db_password          = var.db_password
  tags                 = var.tags
}

# Cache Module
module "cache" {
  source = "./modules/cache"

  project_name      = var.project_name
  environment       = var.environment
  private_subnet_ids = module.networking.private_subnet_ids
  security_group_id = module.networking.redis_security_group_id
  node_type         = var.redis_node_type
  num_cache_nodes   = var.redis_num_cache_nodes
  tags              = var.tags
}

# Edge Module (Route53, CloudFront, WAF, ACM)
module "edge" {
  source = "./modules/edge"

  project_name   = var.project_name
  environment    = var.environment
  domain_name    = var.domain_name
  extra_domains  = []
  alb_dns_name   = module.compute.alb_dns_name
  price_class    = "PriceClass_100"
  rate_limit     = 2000
  tags           = var.tags
}

# Compute Module
module "compute" {
  source = "./modules/compute"

  project_name         = var.project_name
  environment          = var.environment
  region               = var.region
  vpc_id               = module.networking.vpc_id
  public_subnet_ids    = module.networking.public_subnet_ids
  private_subnet_ids   = module.networking.private_subnet_ids
  alb_security_group_id = module.networking.alb_security_group_id
  ecs_security_group_id = module.networking.ecs_security_group_id
  ecs_cpu              = var.ecs_cpu
  ecs_memory           = var.ecs_memory
  ecs_desired_count    = var.ecs_desired_count
  ecs_min_capacity     = var.ecs_min_capacity
  ecs_max_capacity     = var.ecs_max_capacity
  acm_certificate_arn   = module.edge.acm_certificate_arn
  s3_bucket_arn        = module.storage.s3_bucket_arn
  alb_logs_bucket      = module.storage.alb_logs_bucket_name
  secrets_arns         = var.secrets_arns
  container_environment = var.container_environment
  container_secrets    = var.container_secrets
  tags                 = var.tags
}

# Monitoring Module
module "monitoring" {
  source = "./modules/monitoring"

  project_name              = var.project_name
  environment               = var.environment
  ecs_cluster_name          = module.compute.ecs_cluster_name
  ecs_cluster_arn           = "arn:aws:ecs:${var.region}:${data.aws_caller_identity.current.account_id}:cluster/${module.compute.ecs_cluster_name}"
  ecs_service_name          = module.compute.ecs_service_name
  ecs_security_group_id     = module.networking.ecs_security_group_id
  private_subnet_ids        = module.networking.private_subnet_ids
  rds_instance_id           = module.database.rds_instance_id
  alb_arn_suffix            = replace(module.compute.alb_arn, "/^.*:/", "")
  scheduler_task_definition_arn = ""
  ecs_execution_role_arn    = "" # Set if using scheduler
  ecs_task_role_arn        = "" # Set if using scheduler
  alert_emails             = var.alert_emails
  tags                     = var.tags
}

# Data source for current AWS account
data "aws_caller_identity" "current" {}

