<?php

namespace App\Livewire\Admin\Doctors;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class DoctorTable extends Component
{
    use WithPagination;

    public $search = '';
    public $showInactive = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleAvailability($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $doctor->update(['is_available' => !$doctor->is_available]);
        session()->flash('success', 'Doctor availability updated.');
    }

    public function deleteDoctor($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $doctor->delete();
        session()->flash('success', 'Doctor deleted successfully.');
    }

    public function render()
    {
        $doctors = Doctor::withCount('appointments')
            ->when($this->search, fn($query) => 
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('specialization', 'like', '%' . $this->search . '%')
            )
            ->when(!$this->showInactive, fn($query) => 
                $query->where('is_available', true)
            )
            ->latest()
            ->paginate(15);

        return view('livewire.admin.doctors.doctor-table', [
            'doctors' => $doctors,
        ]);
    }
}

