<?php

namespace App\Livewire\Doctor\Patients;

use App\Models\Appointment;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.doctor')]
class PatientList extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
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

    public function render()
    {
        $doctorId = auth()->user()->doctor->id;
        
        // Get distinct patient IDs who have appointments with this doctor
        $patientIds = Appointment::where('doctor_id', $doctorId)
            ->distinct()
            ->pluck('patient_id');

        $patients = User::where('role', 'patient')
            ->whereIn('id', $patientIds)
            ->with(['profile', 'appointments' => function($query) use ($doctorId) {
                $query->where('doctor_id', $doctorId)->latest()->take(1);
            }])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('livewire.doctor.patients.patient-list', [
            'patients' => $patients,
        ]);
    }
}

