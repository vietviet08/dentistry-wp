<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class AppointmentList extends Component
{
    use WithPagination;

    public $statusFilter = 'all'; // all, upcoming, past, cancelled
    
    public function setFilter($status)
    {
        $this->statusFilter = $status;
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

        $query->when($this->statusFilter === 'upcoming', function ($q) {
            $q->upcoming();
        })->when($this->statusFilter === 'past', function ($q) {
            $q->past();
        })->when($this->statusFilter === 'cancelled', function ($q) {
            $q->where('status', 'cancelled');
        });

        return view('livewire.patient.appointments.appointment-list', [
            'appointments' => $query->latest('appointment_date')->paginate(10),
        ]);
    }
}

