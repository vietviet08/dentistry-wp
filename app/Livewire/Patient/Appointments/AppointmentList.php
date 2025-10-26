<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentList extends Component
{
    use WithPagination;

    public $filter = 'all'; // all, upcoming, past, cancelled
    
    public function filter($status)
    {
        $this->filter = $status;
        $this->resetPage();
    }

    public function cancel($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        
        if (!$appointment->canBeCancelledBy(auth()->user())) {
            session()->flash('error', 'You cannot cancel this appointment.');
            return;
        }

        $appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => auth()->id(),
            'cancellation_reason' => 'Cancelled by patient',
        ]);

        session()->flash('success', 'Appointment cancelled successfully.');
    }

    public function render()
    {
        $query = auth()->user()->appointments()->with(['doctor', 'service']);

        $query->when($this->filter === 'upcoming', function ($q) {
            $q->upcoming();
        })->when($this->filter === 'past', function ($q) {
            $q->past();
        })->when($this->filter === 'cancelled', function ($q) {
            $q->where('status', 'cancelled');
        });

        return view('livewire.patient.appointments.appointment-list', [
            'appointments' => $query->latest('appointment_date')->paginate(10),
        ]);
    }
}

