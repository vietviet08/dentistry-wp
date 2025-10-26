<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class AppointmentCalendar extends Component
{
    public $selectedDate;
    public $selectedAppointment = null;

    public function mount()
    {
        $this->selectedDate = now();
    }

    public function selectDate($date)
    {
        $this->selectedDate = \Carbon\Carbon::parse($date);
        $this->selectedAppointment = null;
    }

    public function selectAppointment($appointmentId)
    {
        $this->selectedAppointment = Appointment::with(['patient', 'doctor', 'service'])->findOrFail($appointmentId);
    }

    public function closeDetails()
    {
        $this->selectedAppointment = null;
    }

    public function render()
    {
        $startOfMonth = $this->selectedDate->copy()->startOfMonth()->startOfWeek();
        $endOfMonth = $this->selectedDate->copy()->endOfMonth()->endOfWeek();
        
        $appointments = Appointment::with(['patient', 'doctor', 'service'])
            ->whereBetween('appointment_date', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy('appointment_date');

        $calendar = [];
        $currentDate = $startOfMonth->copy();
        
        while ($currentDate <= $endOfMonth) {
            $date = $currentDate->format('Y-m-d');
            $calendar[] = [
                'date' => $currentDate->copy(),
                'appointments' => $appointments->get($date, collect()),
                'isCurrentMonth' => $currentDate->month === $this->selectedDate->month,
                'isToday' => $currentDate->isToday(),
            ];
            $currentDate->addDay();
        }

        return view('livewire.admin.appointments.appointment-calendar', [
            'calendar' => $calendar,
        ]);
    }
}

