<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();
        
        return view('livewire.patient.dashboard', [
            'services' => Service::where('is_active', true)->count(),
            'doctors' => Doctor::where('is_available', true)->count(),
            'upcomingCount' => $user->appointments()->upcoming()->count(),
            'pastCount' => $user->appointments()->past()->count(),
            'totalCount' => $user->appointments()->count(),
            'upcomingAppointments' => $user->appointments()
                ->with(['doctor', 'service'])
                ->upcoming()
                ->limit(3)
                ->orderBy('appointment_date')
                ->orderBy('appointment_time')
                ->get(),
        ]);
    }
}



