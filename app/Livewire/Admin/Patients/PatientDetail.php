<?php

namespace App\Livewire\Admin\Patients;

use App\Models\Appointment;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class PatientDetail extends Component
{
    use WithPagination;

    public User $patient;
    public $activeTab = 'info';

    public function mount($user)
    {
        $this->patient = User::with([
            'profile',
            'appointments.doctor',
            'appointments.service',
            'documents',
            'reviews'
        ])->findOrFail($user);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function render()
    {
        $upcomingAppointments = Appointment::where('patient_id', $this->patient->id)
            ->upcoming()
            ->with(['doctor', 'service'])
            ->take(5)
            ->get();

        $pastAppointments = Appointment::where('patient_id', $this->patient->id)
            ->whereIn('status', ['completed', 'cancelled', 'no_show'])
            ->with(['doctor', 'service'])
            ->latest('appointment_date')
            ->paginate(10);

        $documents = $this->patient->documents()->latest()->paginate(10);

        return view('livewire.admin.patients.patient-detail', [
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments,
            'documents' => $documents,
        ]);
    }
}

