<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Doctor;
use App\Services\AppointmentService;
use Livewire\Component;

class DoctorSelector extends Component
{
    public $selectedDoctor = '';
    public $serviceId;

    protected $listeners = ['service-selected' => 'updateService'];

    public function mount($serviceId = null)
    {
        $this->serviceId = $serviceId;
    }

    public function updateService($serviceId)
    {
        $this->serviceId = $serviceId;
        $this->selectedDoctor = ''; // Reset selection
    }

    public function selectDoctor($doctorId)
    {
        $this->selectedDoctor = $doctorId;
        $this->dispatch('doctor-selected', doctorId: $doctorId);
    }

    public function render()
    {
        $doctors = collect();

        if ($this->serviceId) {
            // In a real scenario, you might filter doctors by service compatibility
            // For now, show all available doctors
            $doctors = Doctor::where('is_available', true)
                ->orderBy('name')
                ->get();
        }

        return view('livewire.patient.appointments.doctor-selector', [
            'doctors' => $doctors,
        ]);
    }
}

