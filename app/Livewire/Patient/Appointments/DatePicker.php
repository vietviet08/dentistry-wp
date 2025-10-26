<?php

namespace App\Livewire\Patient\Appointments;

use App\Services\AppointmentService;
use Livewire\Component;

class DatePicker extends Component
{
    public $selectedDate = '';
    public $doctorId;
    public $availableDates;

    protected $listeners = ['doctor-selected' => 'updateDoctor'];

    public function mount($doctorId = null)
    {
        $this->doctorId = $doctorId;
        $this->loadAvailableDates();
    }

    public function updateDoctor($doctorId)
    {
        $this->doctorId = $doctorId;
        $this->selectedDate = '';
        $this->loadAvailableDates();
    }

    public function loadAvailableDates()
    {
        if ($this->doctorId) {
            $service = app(AppointmentService::class);
            $this->availableDates = $service->getAvailableDates($this->doctorId);
        } else {
            $this->availableDates = collect();
        }
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;
        $this->dispatch('date-selected', date: $date);
    }

    public function render()
    {
        return view('livewire.patient.appointments.date-picker');
    }
}

