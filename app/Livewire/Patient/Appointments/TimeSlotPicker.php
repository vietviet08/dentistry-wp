<?php

namespace App\Livewire\Patient\Appointments;

use App\Services\AppointmentService;
use Livewire\Component;

class TimeSlotPicker extends Component
{
    public $selectedTime = '';
    public $doctorId;
    public $appointmentDate;
    public $slots;

    protected $listeners = ['doctor-selected' => 'updateDoctor', 'date-selected' => 'updateDate'];

    public function mount($doctorId = null, $appointmentDate = null)
    {
        $this->doctorId = $doctorId;
        $this->appointmentDate = $appointmentDate;
        $this->loadSlots();
    }

    public function updateDoctor($doctorId)
    {
        $this->doctorId = $doctorId;
        $this->selectedTime = '';
        $this->loadSlots();
    }

    public function updateDate($date)
    {
        $this->appointmentDate = $date;
        $this->selectedTime = '';
        $this->loadSlots();
    }

    public function loadSlots()
    {
        if ($this->doctorId && $this->appointmentDate) {
            $service = app(AppointmentService::class);
            $this->slots = $service->getAvailableSlots($this->doctorId, $this->appointmentDate);
        } else {
            $this->slots = collect();
        }
    }

    public function selectTime($time)
    {
        $this->selectedTime = $time;
        $this->dispatch('time-selected', time: $time);
    }

    public function render()
    {
        return view('livewire.patient.appointments.time-slot-picker');
    }
}

