<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalUsers' => User::count(),
            'totalServices' => Service::count(),
            'totalDoctors' => Doctor::count(),
            'activeDoctors' => Doctor::where('is_available', true)->count(),
        ]);
    }
}

