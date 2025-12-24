<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Illuminate\Support\Str;

class FileUploadService
{
    protected ImageManager $imageManager;

    public function __construct()
    {
        // Auto-detect available driver
        $driver = $this->getAvailableDriver();
        $this->imageManager = new ImageManager($driver);
    }

    /**
     * Get available image driver (Imagick preferred, fallback to GD)
     */
    protected function getAvailableDriver(): GdDriver|ImagickDriver
    {
        // Try Imagick first (better quality)
        if (extension_loaded('imagick')) {
            return new ImagickDriver();
        }

        // Fallback to GD
        if (extension_loaded('gd')) {
            return new GdDriver();
        }

        // If neither is available, throw exception
        throw new \RuntimeException(
            'Neither GD nor Imagick PHP extension is installed. ' .
            'Please install one of them to use image processing features.'
        );
    }
    /**
     * Get the storage disk to use (minio or public based on config)
     */
    protected function getDisk(): string
    {
        return config('filesystems.default', 'public');
    }

    /**
     * Get file path for image processing (handles both regular and temporary files)
     */
    protected function getImageFilePath(UploadedFile $file): string
    {
        // Validate file is actually an image
        if (!$file->isValid()) {
            throw new \RuntimeException('Uploaded file is not valid.');
        }

        // Check MIME type
        $mimeType = $file->getMimeType();
        $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $allowedMimes)) {
            throw new \RuntimeException("Invalid image type: {$mimeType}. Allowed types: " . implode(', ', $allowedMimes));
        }

        // Try getRealPath() first (standard uploaded files)
        $realPath = $file->getRealPath();
        
        // If getRealPath() returns false or file doesn't exist, try alternatives
        if ($realPath === false || !file_exists($realPath) || !is_readable($realPath)) {
            // Try getPathname() (for temporary files)
            $realPath = $file->getPathname();
            
            // If still not found, try path + filename
            if (!file_exists($realPath) || !is_readable($realPath)) {
                $realPath = $file->getPath() . DIRECTORY_SEPARATOR . $file->getFilename();
            }
            
            // For Livewire: if file still not accessible, store temporarily and read from there
            if (!file_exists($realPath) || !is_readable($realPath)) {
                // Store file temporarily to get a readable path
                $tempPath = storage_path('app/temp/' . Str::uuid() . '.' . $file->getClientOriginalExtension());
                $tempDir = dirname($tempPath);
                
                if (!is_dir($tempDir)) {
                    mkdir($tempDir, 0755, true);
                }
                
                // Move uploaded file to temp location
                $file->move($tempDir, basename($tempPath));
                $realPath = $tempPath;
            }
        }
        
        if (!file_exists($realPath) || !is_readable($realPath)) {
            throw new \RuntimeException(
                'Unable to locate uploaded file for processing. ' .
                'File path: ' . ($realPath ?? 'null') . 
                ', Real path: ' . ($file->getRealPath() ?: 'false') .
                ', Pathname: ' . $file->getPathname() .
                ', Is valid: ' . ($file->isValid() ? 'yes' : 'no')
            );
        }
        
        return $realPath;
    }

    /**
     * Upload avatar image
     */
    public function uploadAvatar(UploadedFile $file): string
    {
        $filename = Str::uuid() . '.jpg';
        $path = "avatars/{$filename}";

        // Resize and optimize image
        $image = $this->imageManager->read($this->getImageFilePath($file))
            ->cover(400, 400)
            ->toJpeg(85)
            ->toString();

        Storage::disk($this->getDisk())->put($path, $image);

        return $path;
    }

    /**
     * Upload doctor photo
     */
    public function uploadDoctorPhoto(UploadedFile $file): string
    {
        $filename = Str::uuid() . '.jpg';
        $path = "doctors/{$filename}";

        // Resize and optimize image
        $image = $this->imageManager->read($this->getImageFilePath($file))
            ->cover(800, 800)
            ->toJpeg(85)
            ->toString();

        Storage::disk($this->getDisk())->put($path, $image);

        return $path;
    }

    /**
     * Upload service image
     */
    public function uploadServiceImage(UploadedFile $file): string
    {
        $filename = Str::uuid() . '.jpg';
        $path = "services/{$filename}";

        // Resize and optimize image
        $image = $this->imageManager->read($this->getImageFilePath($file))
            ->cover(1200, 800)
            ->toJpeg(85)
            ->toString();

        Storage::disk($this->getDisk())->put($path, $image);

        return $path;
    }

    /**
     * Upload blog post featured image
     */
    public function uploadPostImage(UploadedFile $file): string
    {
        $filename = Str::uuid() . '.jpg';
        $path = "posts/{$filename}";

        try {
            // Try to read from file path first
            $filePath = $this->getImageFilePath($file);
            $image = $this->imageManager->read($filePath)
                ->cover(1200, 630)
                ->toJpeg(85)
                ->toString();
        } catch (\Exception $e) {
            // Fallback: read from file stream if path-based reading fails
            $image = $this->imageManager->read($file->get())
                ->cover(1200, 630)
                ->toJpeg(85)
                ->toString();
        }

        Storage::disk($this->getDisk())->put($path, $image);

        return $path;
    }

    /**
     * Upload gallery image with thumbnail
     */
    public function uploadGalleryImage(UploadedFile $file): array
    {
        $filename = Str::uuid() . '.jpg';
        $originalPath = "gallery/originals/{$filename}";
        $thumbnailPath = "gallery/thumbnails/{$filename}";

        $filePath = $this->getImageFilePath($file);

        // Original image
        $image = $this->imageManager->read($filePath)
            ->scaleDown(1920, null)
            ->toJpeg(90)
            ->toString();

        Storage::disk($this->getDisk())->put($originalPath, $image);

        // Thumbnail
        $thumbnail = $this->imageManager->read($filePath)
            ->cover(400, 400)
            ->toJpeg(80)
            ->toString();

        Storage::disk($this->getDisk())->put($thumbnailPath, $thumbnail);

        return [
            'image_path' => $originalPath,
            'thumbnail_path' => $thumbnailPath,
        ];
    }

    /**
     * Upload patient document
     */
    public function uploadDocument(UploadedFile $file, int $userId, string $type = 'other'): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;
        
        // Organize by user and type
        $path = "documents/{$userId}/{$type}/{$filename}";

        Storage::disk($this->getDisk())->putFileAs(
            dirname($path),
            $file,
            basename($path)
        );

        return $path;
    }

    /**
     * Delete file from storage
     */
    public function deleteFile(string $path): bool
    {
        return Storage::disk($this->getDisk())->delete($path);
    }

    /**
     * Check if file exists
     */
    public function fileExists(string $path): bool
    {
        return Storage::disk($this->getDisk())->exists($path);
    }

    /**
     * Get file URL
     */
    public function getFileUrl(string $path): ?string
    {
        if (!$this->fileExists($path)) {
            return null;
        }

        return Storage::disk($this->getDisk())->url($path);
    }

    /**
     * Get temporary URL (for private files)
     */
    public function getTemporaryUrl(string $path, int $expirationMinutes = 60): ?string
    {
        if (!$this->fileExists($path)) {
            return null;
        }

        try {
            return Storage::disk($this->getDisk())->temporaryUrl($path, now()->addMinutes($expirationMinutes));
        } catch (\Exception $e) {
            // Fallback to regular URL if temporary URL not supported
            return $this->getFileUrl($path);
        }
    }
}

