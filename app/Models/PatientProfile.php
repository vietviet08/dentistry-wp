<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'allergies',
        'medical_conditions',
        'insurance_provider',
        'insurance_number',
        'blood_type',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
