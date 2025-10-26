<?php

namespace App\Livewire\Patient\Profile;

use App\Models\PatientProfile;
use Livewire\Component;

class MedicalInfo extends Component
{
    public $address;
    public $emergency_contact_name;
    public $emergency_contact_phone;
    public $allergies;
    public $medical_conditions;
    public $insurance_provider;
    public $insurance_number;
    public $blood_type;

    protected $rules = [
        'address' => 'nullable|string|max:500',
        'emergency_contact_name' => 'nullable|string|max:255',
        'emergency_contact_phone' => 'nullable|string|max:20',
        'allergies' => 'nullable|string|max:1000',
        'medical_conditions' => 'nullable|string|max:1000',
        'insurance_provider' => 'nullable|string|max:255',
        'insurance_number' => 'nullable|string|max:255',
        'blood_type' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
    ];

    public function mount()
    {
        $profile = auth()->user()->patientProfile;
        
        if ($profile) {
            $this->address = $profile->address;
            $this->emergency_contact_name = $profile->emergency_contact_name;
            $this->emergency_contact_phone = $profile->emergency_contact_phone;
            $this->allergies = $profile->allergies;
            $this->medical_conditions = $profile->medical_conditions;
            $this->insurance_provider = $profile->insurance_provider;
            $this->insurance_number = $profile->insurance_number;
            $this->blood_type = $profile->blood_type;
        }
    }

    public function save()
    {
        $this->validate();

        PatientProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'address' => $this->address,
                'emergency_contact_name' => $this->emergency_contact_name,
                'emergency_contact_phone' => $this->emergency_contact_phone,
                'allergies' => $this->allergies,
                'medical_conditions' => $this->medical_conditions,
                'insurance_provider' => $this->insurance_provider,
                'insurance_number' => $this->insurance_number,
                'blood_type' => $this->blood_type,
            ]
        );

        session()->flash('success', 'Medical information updated successfully!');
    }

    public function render()
    {
        return view('livewire.patient.profile.medical-info');
    }
}
