<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class AppointmentTable extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $doctorFilter = '';
    public $dateFilter = '';
    public $selectedAppointment = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'doctorFilter' => ['except' => ''],
        'dateFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingDoctorFilter()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function confirmAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        
        if (auth()->user()->can('confirm', $appointment)) {
            $appointment->confirm();
            session()->flash('success', 'Appointment confirmed successfully.');
        }
    }

    public function cancelAppointment($appointmentId)
    {
        $this->selectedAppointment = $appointmentId;
    }

    public function completeAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        
        if (auth()->user()->can('complete', $appointment)) {
            $appointment->complete();
            session()->flash('success', 'Appointment marked as completed.');
        }
    }

    public function render()
    {
        $appointments = Appointment::with(['patient', 'doctor', 'service'])
            ->when($this->search, function ($query) {
                $query->whereHas('patient', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('doctor', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('service', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, fn($query) => 
                $query->where('status', $this->statusFilter)
            )
            ->when($this->doctorFilter, fn($query) => 
                $query->where('doctor_id', $this->doctorFilter)
            )
            ->when($this->dateFilter, fn($query) => 
                $query->where('appointment_date', $this->dateFilter)
            )
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->paginate(15);

        $doctors = Doctor::orderBy('name')->get();
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled', 'no_show'];

        return view('livewire.admin.appointments.appointment-table', [
            'appointments' => $appointments,
            'doctors' => $doctors,
            'statuses' => $statuses,
        ]);
    }
}

