<?php

namespace App\Livewire\Patient;

use App\Models\Doctor;
use App\Models\Service;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.patient.dashboard', [
            'services' => Service::where('is_active', true)->count(),
            'doctors' => Doctor::where('is_available', true)->count(),
        ]);
    }
}

