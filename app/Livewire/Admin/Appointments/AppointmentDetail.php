<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class AppointmentDetail extends Component
{
    public Appointment $appointment;
    public $adminNotes = '';
    public $cancellationReason = '';
    public $showCancelModal = false;

    public function mount($appointment)
    {
        $this->appointment = $appointment;
        $this->adminNotes = $appointment->admin_notes ?? '';
    }

    public function confirmAppointment()
    {
        if (auth()->user()->can('confirm', $this->appointment)) {
            $this->appointment->confirm();
            session()->flash('success', 'Appointment confirmed successfully.');
            $this->dispatch('appointment-updated');
        }
    }

    public function completeAppointment()
    {
        if (auth()->user()->can('complete', $this->appointment)) {
            $this->appointment->complete();
            session()->flash('success', 'Appointment marked as completed.');
            $this->dispatch('appointment-updated');
        }
    }

    public function cancelAppointment()
    {
        if (!empty($this->cancellationReason)) {
            $this->appointment->cancel($this->cancellationReason);
            session()->flash('success', 'Appointment cancelled.');
            $this->showCancelModal = false;
            $this->cancellationReason = '';
            $this->dispatch('appointment-updated');
        }
    }

    public function saveAdminNotes()
    {
        $this->appointment->update(['admin_notes' => $this->adminNotes]);
        session()->flash('success', 'Admin notes saved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.appointments.appointment-detail');
    }
}

