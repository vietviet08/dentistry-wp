terraform {
  backend "s3" {
    # Configure these values for your S3 backend
    # bucket = "dentistry-terraform-state"
    # key    = "dentistry/terraform.tfstate"
    # region = "ap-southeast-1"
    # dynamodb_table = "terraform-state-lock"
    # encrypt = true
  }
}

# Note: Uncomment and configure the above values after creating the S3 bucket
# for Terraform state storage and DynamoDB table for state locking

