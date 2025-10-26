<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'specialization',
        'qualification',
        'experience_years',
        'bio',
        'photo',
        'email',
        'phone',
        'consultation_fee',
        'is_available',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'consultation_fee' => 'decimal:2',
            'is_available' => 'boolean',
            'experience_years' => 'integer',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function upcomingAppointments()
    {
        return $this->appointments()->where('appointment_date', '>=', today());
    }

    // Route binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($doctor) {
            if (empty($doctor->slug)) {
                $doctor->slug = Str::slug($doctor->name);
            }
        });
    }
}
