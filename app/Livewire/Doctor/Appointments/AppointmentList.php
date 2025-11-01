<?php

namespace App\Livewire\Doctor\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.doctor')]
class AppointmentList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $dateFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'dateFilter' => ['except' => ''],
    ];

    public function mount()
    {
        if (!auth()->user()->doctor) {
            abort(403, 'Doctor profile not found');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $doctorId = auth()->user()->doctor->id;

        $appointments = Appointment::where('doctor_id', $doctorId)
            ->with(['patient', 'service'])
            ->when($this->search, function ($query) {
                $query->whereHas('patient', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('service', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, fn($query) => 
                $query->where('status', $this->statusFilter)
            )
            ->when($this->dateFilter, fn($query) => 
                $query->where('appointment_date', $this->dateFilter)
            )
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->paginate(15);

        $statuses = ['pending', 'confirmed', 'completed', 'cancelled', 'no_show'];

        return view('livewire.doctor.appointments.appointment-list', [
            'appointments' => $appointments,
            'statuses' => $statuses,
        ]);
    }
}

