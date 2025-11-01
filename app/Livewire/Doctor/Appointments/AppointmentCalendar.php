<?php

namespace App\Livewire\Doctor\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.doctor')]
class AppointmentCalendar extends Component
{
    public $selectedDate;
    public $selectedAppointment = null;

    public function mount()
    {
        if (!auth()->user()->doctor) {
            abort(403, 'Doctor profile not found');
        }
        
        $this->selectedDate = now();
    }

    public function selectDate($date)
    {
        $this->selectedDate = \Carbon\Carbon::parse($date);
        $this->selectedAppointment = null;
    }

    public function selectAppointment($appointmentId)
    {
        $doctorId = auth()->user()->doctor->id;
        $appointment = Appointment::where('doctor_id', $doctorId)
            ->with(['patient', 'service'])
            ->findOrFail($appointmentId);
        
        $this->selectedAppointment = $appointment;
    }

    public function closeDetails()
    {
        $this->selectedAppointment = null;
    }

    public function previousMonth()
    {
        $this->selectedDate = $this->selectedDate->copy()->subMonth();
    }

    public function nextMonth()
    {
        $this->selectedDate = $this->selectedDate->copy()->addMonth();
    }

    public function render()
    {
        $doctorId = auth()->user()->doctor->id;
        
        $startOfMonth = $this->selectedDate->copy()->startOfMonth()->startOfWeek();
        $endOfMonth = $this->selectedDate->copy()->endOfMonth()->endOfWeek();
        
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->with(['patient', 'service'])
            ->whereBetween('appointment_date', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy(function ($appointment) {
                return $appointment->appointment_date->format('Y-m-d');
            });

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

        return view('livewire.doctor.appointments.appointment-calendar', [
            'calendar' => $calendar,
        ]);
    }
}

