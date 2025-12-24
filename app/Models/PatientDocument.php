<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class PatientDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'type',
        'title',
        'file_path',
        'file_size',
        'mime_type',
        'uploaded_by',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Accessors
    public function getFileSizeHumanAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    /**
     * Get file URL (temporary URL for private documents)
     */
    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        $disk = config('filesystems.default');
        
        // For private documents, use temporary URL
        try {
            return Storage::disk($disk)->temporaryUrl($this->file_path, now()->addHours(1));
        } catch (\Exception $e) {
            // Fallback to regular URL if temporary URL not supported
            return Storage::disk($disk)->url($this->file_path);
        }
    }
}
