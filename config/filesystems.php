<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'ap-southeast-1'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            // When using IAM roles (ECS), key and secret can be null
            'use_aws_shared_config_files' => true,
            'throw' => false,
            'report' => false,
        ],

        'minio' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID') ?: env('MINIO_ROOT_USER', 'minioadmin'),
            'secret' => env('AWS_SECRET_ACCESS_KEY') ?: env('MINIO_ROOT_PASSWORD', 'minioadmin'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'bucket' => env('AWS_BUCKET') ?: env('MINIO_BUCKET', 'dentistry'),
            // URL for accessing files: MinIO with path-style needs bucket in path
            'url' => env('AWS_URL') ?: env('MINIO_URL') ?: (
                (env('AWS_BUCKET') ?: env('MINIO_BUCKET', 'dentistry'))
                ? 'http://localhost:9000/' . (env('AWS_BUCKET') ?: env('MINIO_BUCKET', 'dentistry'))
                : 'http://localhost:9000'
            ),
            // Auto-detect endpoint: use 'minio' hostname if running in Docker, 'localhost' if on host
            'endpoint' => env('AWS_ENDPOINT') ?: env('MINIO_ENDPOINT') ?: (
                // Check if running in Docker (Laravel Sail) or on host
                env('LARAVEL_SAIL') ? 'http://minio:9000' : 'http://localhost:9000'
            ),
            'use_path_style_endpoint' => true, // Required for MinIO
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
