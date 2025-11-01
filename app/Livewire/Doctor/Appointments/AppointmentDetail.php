<?php

namespace App\Livewire\Doctor\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.doctor')]
class AppointmentDetail extends Component
{
    public Appointment $appointment;
    public $adminNotes = '';
    public $cancellationReason = '';
    public $showCancelModal = false;

    public function mount($appointment)
    {
        $doctor = auth()->user()->doctor;
        
        if (!$doctor || !$appointment->belongsToDoctor(auth()->user())) {
            abort(403, 'Unauthorized access to this appointment');
        }
        
        $this->appointment = $appointment->load(['patient', 'service']);
        $this->adminNotes = $appointment->admin_notes ?? '';
    }

    public function confirmAppointment()
    {
        if (auth()->user()->can('confirm', $this->appointment)) {
            $this->appointment->confirm();
            session()->flash('success', __('doctor.appointments.confirmed_success'));
            $this->dispatch('appointment-updated');
        }
    }

    public function completeAppointment()
    {
        if (auth()->user()->can('complete', $this->appointment)) {
            $this->appointment->complete();
            session()->flash('success', __('doctor.appointments.completed_success'));
            $this->dispatch('appointment-updated');
        }
    }

    public function markAsNoShow()
    {
        if (auth()->user()->can('markAsNoShow', $this->appointment)) {
            $this->appointment->markAsNoShow();
            session()->flash('success', __('doctor.appointments.no_show_marked'));
            $this->dispatch('appointment-updated');
        }
    }

    public function cancelAppointment()
    {
        if (!empty($this->cancellationReason)) {
            if (auth()->user()->can('cancel', $this->appointment)) {
                $this->appointment->cancel($this->cancellationReason);
                session()->flash('success', __('doctor.appointments.cancelled_success'));
                $this->showCancelModal = false;
                $this->cancellationReason = '';
                $this->dispatch('appointment-updated');
            }
        }
    }

    public function saveAdminNotes()
    {
        $this->appointment->update(['admin_notes' => $this->adminNotes]);
        session()->flash('success', __('doctor.appointments.notes_saved'));
    }

    public function render()
    {
        return view('livewire.doctor.appointments.appointment-detail');
    }
}

