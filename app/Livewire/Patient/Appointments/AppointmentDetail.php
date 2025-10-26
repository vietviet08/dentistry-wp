<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use Livewire\Component;

class AppointmentDetail extends Component
{
    public Appointment $appointment;

    public function mount(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        $this->appointment = $appointment->load(['doctor', 'service', 'patient']);
    }

    public function cancel()
    {
        $this->authorize('cancel', $this->appointment);

        $this->appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => auth()->id(),
            'cancellation_reason' => 'Cancelled by patient',
        ]);

        session()->flash('success', 'Appointment cancelled successfully.');
        return redirect()->route('appointments.index');
    }

    public function render()
    {
        return view('livewire.patient.appointments.appointment-detail');
    }
}

