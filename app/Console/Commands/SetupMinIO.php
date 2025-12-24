<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class SetupMinIO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minio:setup {--test : Test connection only}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup MinIO bucket and test connection';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $disk = config('filesystems.default', 'public');
        
        if ($disk !== 'minio') {
            $this->warn("Current filesystem disk is '{$disk}', not 'minio'.");
            $this->info("To use MinIO, set FILESYSTEM_DISK=minio in your .env file.");
            
            if (!$this->confirm('Do you want to continue anyway?', false)) {
                return Command::FAILURE;
            }
        }

        $this->info('Setting up MinIO...');
        $this->newLine();

        // Get MinIO configuration
        $config = config('filesystems.disks.minio');
        
        if (!$config) {
            $this->error('MinIO disk configuration not found in config/filesystems.php');
            return Command::FAILURE;
        }

        $this->info('Configuration:');
        $this->line("  Endpoint: {$config['endpoint']}");
        $this->line("  Bucket: {$config['bucket']}");
        $this->line("  Region: {$config['region']}");
        $this->newLine();

        // Test connection
        $this->info('Testing connection...');
        
        try {
            $s3Client = new S3Client([
                'version' => 'latest',
                'region' => $config['region'],
                'endpoint' => $config['endpoint'],
                'use_path_style_endpoint' => $config['use_path_style_endpoint'],
                'credentials' => [
                    'key' => $config['key'],
                    'secret' => $config['secret'],
                ],
            ]);

            // List buckets to test connection
            $result = $s3Client->listBuckets();
            $this->info('✓ Connection successful!');
            $this->newLine();

            // Check if bucket exists
            $bucketName = $config['bucket'];
            $buckets = array_column($result['Buckets'], 'Name');
            
            if (in_array($bucketName, $buckets)) {
                $this->info("✓ Bucket '{$bucketName}' already exists.");
                
                // Ensure bucket policy is set for public read access
                if (!$this->option('test')) {
                    $this->info('Setting bucket policy for public read access...');
                    try {
                        $policy = json_encode([
                            'Version' => '2012-10-17',
                            'Statement' => [
                                [
                                    'Effect' => 'Allow',
                                    'Principal' => '*',
                                    'Action' => ['s3:GetObject'],
                                    'Resource' => ["arn:aws:s3:::{$bucketName}/*"],
                                ],
                            ],
                        ]);
                        
                        $s3Client->putBucketPolicy([
                            'Bucket' => $bucketName,
                            'Policy' => $policy,
                        ]);
                        
                        $this->info("✓ Bucket policy updated successfully!");
                    } catch (AwsException $e) {
                        $this->warn("⚠ Could not update bucket policy: " . $e->getMessage());
                        $this->info("You may need to set it manually in MinIO console.");
                    }
                }
            } else {
                $this->warn("Bucket '{$bucketName}' does not exist.");
                
                if ($this->option('test')) {
                    $this->info('Skipping bucket creation (--test mode)');
                } else {
                    if ($this->confirm("Create bucket '{$bucketName}'?", true)) {
                        try {
                            $s3Client->createBucket([
                                'Bucket' => $bucketName,
                                'ACL' => 'public-read',
                            ]);
                            
                            // Set bucket policy for public read access
                            $policy = json_encode([
                                'Version' => '2012-10-17',
                                'Statement' => [
                                    [
                                        'Effect' => 'Allow',
                                        'Principal' => '*',
                                        'Action' => ['s3:GetObject'],
                                        'Resource' => ["arn:aws:s3:::{$bucketName}/*"],
                                    ],
                                ],
                            ]);
                            
                            $s3Client->putBucketPolicy([
                                'Bucket' => $bucketName,
                                'Policy' => $policy,
                            ]);
                            
                            $this->info("✓ Bucket '{$bucketName}' created successfully!");
                        } catch (AwsException $e) {
                            $this->error("Failed to create bucket: " . $e->getMessage());
                            return Command::FAILURE;
                        }
                    }
                }
            }

            // Test file operations
            if (!$this->option('test')) {
                $this->newLine();
                $this->info('Testing file operations...');
                
                $testPath = 'test/connection.txt';
                $testContent = 'MinIO connection test - ' . now()->toDateTimeString();
                
                try {
                    // Write test file
                    Storage::disk('minio')->put($testPath, $testContent);
                    $this->info('✓ File upload successful');
                    
                    // Read test file
                    $content = Storage::disk('minio')->get($testPath);
                    if ($content === $testContent) {
                        $this->info('✓ File read successful');
                    } else {
                        $this->warn('⚠ File content mismatch');
                    }
                    
                    // Get URL
                    $url = Storage::disk('minio')->url($testPath);
                    $this->info("✓ File URL: {$url}");
                    
                    // Delete test file
                    Storage::disk('minio')->delete($testPath);
                    $this->info('✓ File delete successful');
                    
                } catch (\Exception $e) {
                    $this->error("File operation failed: " . $e->getMessage());
                    return Command::FAILURE;
                }
            }

            $this->newLine();
            $this->info('✓ MinIO setup completed successfully!');
            
            return Command::SUCCESS;
            
        } catch (AwsException $e) {
            $this->error('AWS Error: ' . $e->getMessage());
            $this->error('Error Code: ' . $e->getAwsErrorCode());
            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}

