<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'end_time',
        'status',
        'notes',
        'admin_notes',
        'cancellation_reason',
        'cancelled_by',
        'confirmed_by',
        'confirmed_at',
        'cancelled_at',
        'reminder_sent_at',
        'qr_code',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
            'appointment_time' => 'datetime',
            'end_time' => 'datetime',
            'confirmed_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'reminder_sent_at' => 'datetime',
        ];
    }

    // Relationships
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Accessors
    public function getAppointmentDatetimeAttribute()
    {
        return Carbon::parse("{$this->appointment_date} {$this->appointment_time}");
    }

    public function getEndDatetimeAttribute()
    {
        if ($this->end_time) {
            return Carbon::parse("{$this->appointment_date} {$this->end_time}");
        }
        return $this->appointment_datetime->copy()->addMinutes($this->service->duration);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>=', today())
            ->whereIn('status', ['pending', 'confirmed']);
    }

    public function scopePast($query)
    {
        return $query->where('appointment_date', '<', today())
            ->orWhere(function ($q) {
                $q->where('appointment_date', today())
                  ->where('appointment_time', '<', now()->format('H:i'));
            });
    }

    // Business Logic
    /**
     * Check if appointment belongs to a specific doctor
     */
    public function belongsToDoctor(User $user): bool
    {
        if (!$user->isDoctor() || !$user->doctor) {
            return false;
        }

        return $this->doctor_id === $user->doctor->id;
    }

    public function canBeCancelledBy(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isDoctor() && $this->belongsToDoctor($user)) {
            return true;
        }

        return $user->id === $this->patient_id
            && $this->status === 'pending'
            && $this->appointment_date >= today();
    }

    public function canBeRescheduledBy(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isDoctor() && $this->belongsToDoctor($user)) {
            return in_array($this->status, ['pending', 'confirmed'])
                && $this->appointment_date >= today();
        }

        return $user->id === $this->patient_id
            && in_array($this->status, ['pending', 'confirmed'])
            && $this->appointment_date >= today();
    }

    public function cancel(string $reason, ?User $cancelledBy = null): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
            'cancelled_by' => $cancelledBy?->id ?? auth()->id(),
            'cancelled_at' => now(),
        ]);
    }

    public function confirm(?User $confirmedBy = null): void
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_by' => $confirmedBy?->id ?? auth()->id(),
            'confirmed_at' => now(),
        ]);
    }

    public function complete(): void
    {
        $this->update(['status' => 'completed']);
    }

    public function markAsNoShow(): void
    {
        $this->update(['status' => 'no_show']);
    }

    public function calculateEndTime(): void
    {
        if (!$this->service) {
            return;
        }

        $startTime = Carbon::parse($this->appointment_time);
        $endTime = $startTime->copy()->addMinutes($this->service->duration);

        $this->update([
            'end_time' => $endTime->format('H:i:s'),
        ]);
    }

    /**
     * Generate QR code if it doesn't exist yet
     * Useful for appointments created before QR code feature was added
     */
    public function generateQRCodeIfNeeded(): void
    {
        if ($this->qr_code && \Storage::disk(config('filesystems.default'))->exists($this->qr_code)) {
            return;
        }

        try {
            $qrCodeService = app(\App\Services\QRCodeService::class);
            $qrCodePath = $qrCodeService->generateForAppointment($this);
            
            $this->update(['qr_code' => $qrCodePath]);
        } catch (\Exception $e) {
            // Log error but don't crash the page
            \Log::warning('QR code generation failed in generateQRCodeIfNeeded', [
                'appointment_id' => $this->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            // QR code generation failed, but we continue without it
            // It can be generated later or manually
        }
    }
}

