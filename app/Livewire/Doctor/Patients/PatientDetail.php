<?php

namespace App\Livewire\Doctor\Patients;

use App\Models\Appointment;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.doctor')]
class PatientDetail extends Component
{
    use WithPagination;

    public User $patient;
    public $activeTab = 'info';

    public function mount($user)
    {
        $doctor = auth()->user()->doctor;
        
        if (!$doctor) {
            abort(403, 'Doctor profile not found');
        }

        $patient = User::with([
            'profile',
        ])->findOrFail($user);
        
        // Verify patient has appointments with this doctor
        $hasAppointments = Appointment::where('patient_id', $patient->id)
            ->where('doctor_id', $doctor->id)
            ->exists();
        
        if (!$hasAppointments) {
            abort(403, 'Patient has no appointments with this doctor');
        }
        
        $this->patient = $patient;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function render()
    {
        $doctorId = auth()->user()->doctor->id;
        
        $upcomingAppointments = Appointment::where('patient_id', $this->patient->id)
            ->where('doctor_id', $doctorId)
            ->upcoming()
            ->with(['service'])
            ->take(5)
            ->get();

        $pastAppointments = Appointment::where('patient_id', $this->patient->id)
            ->where('doctor_id', $doctorId)
            ->whereIn('status', ['completed', 'cancelled', 'no_show'])
            ->with(['service'])
            ->latest('appointment_date')
            ->paginate(10);

        return view('livewire.doctor.patients.patient-detail', [
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments,
        ]);
    }
}

