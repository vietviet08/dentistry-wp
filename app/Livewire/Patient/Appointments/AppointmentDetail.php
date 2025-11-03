<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class AppointmentDetail extends Component
{
    public Appointment $appointment;

    public function mount(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        $this->appointment = $appointment->load(['doctor', 'service', 'patient']);
        
        // Generate QR code if it doesn't exist
        if ($appointment->status !== 'cancelled') {
            $this->appointment->generateQRCodeIfNeeded();
        }
    }

    public $isRescheduling = false;
    public $newDate;
    public $newTime;

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

    public function startReschedule()
    {
        $this->authorize('reschedule', $this->appointment);
        $this->isRescheduling = true;
        $this->newDate = $this->appointment->appointment_date->format('Y-m-d');
        $this->newTime = $this->appointment->appointment_time->format('H:i');
    }

    public function cancelReschedule()
    {
        $this->isRescheduling = false;
        $this->newDate = null;
        $this->newTime = null;
    }

    public function reschedule()
    {
        $this->authorize('reschedule', $this->appointment);

        $this->validate([
            'newDate' => 'required|date|after:today',
            'newTime' => 'required|date_format:H:i',
        ]);

        // Check if the new slot is available
        $service = app(\App\Services\AppointmentService::class);
        $availableSlots = $service->getAvailableSlots(
            $this->appointment->doctor_id,
            $this->newDate
        );

        if (!$availableSlots->contains($this->newTime)) {
            $this->addError('newTime', 'The selected time slot is not available.');
            return;
        }

        // Calculate new end time
        $endTime = \Carbon\Carbon::parse($this->newTime)
            ->addMinutes($this->appointment->service->duration);

        $this->appointment->update([
            'appointment_date' => $this->newDate,
            'appointment_time' => $this->newTime,
            'end_time' => $endTime->format('H:i:s'),
            'status' => 'pending',
        ]);

        session()->flash('success', 'Appointment rescheduled successfully.');
        $this->isRescheduling = false;
    }

    public function render()
    {
        return view('livewire.patient.appointments.appointment-detail');
    }
}

