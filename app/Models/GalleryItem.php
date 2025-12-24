<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'image_path',
        'thumbnail_path',
        'description',
        'is_before_after',
        'before_image',
        'after_image',
        'order',
        'is_featured',
    ];

    protected $casts = [
        'is_before_after' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        return Storage::disk(config('filesystems.default'))->url($this->image_path);
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail_path) {
            return $this->image_url;
        }

        return Storage::disk(config('filesystems.default'))->url($this->thumbnail_path);
    }

    /**
     * Get before image URL
     */
    public function getBeforeImageUrlAttribute(): ?string
    {
        if (!$this->before_image) {
            return null;
        }

        return Storage::disk(config('filesystems.default'))->url($this->before_image);
    }

    /**
     * Get after image URL
     */
    public function getAfterImageUrlAttribute(): ?string
    {
        if (!$this->after_image) {
            return null;
        }

        return Storage::disk(config('filesystems.default'))->url($this->after_image);
    }
}
