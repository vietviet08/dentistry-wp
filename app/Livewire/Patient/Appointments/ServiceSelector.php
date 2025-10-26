<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Service;
use Livewire\Component;

class ServiceSelector extends Component
{
    public $selectedService = '';
    public $category = '';
    
    public function selectService($serviceId)
    {
        $this->selectedService = $serviceId;
        $this->dispatch('service-selected', serviceId: $serviceId);
    }

    public function filterByCategory($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.patient.appointments.service-selector', [
            'services' => Service::where('is_active', true)
                ->when($this->category, fn($q) => $q->where('category', $this->category))
                ->orderBy('order')
                ->orderBy('name')
                ->get(),
            'categories' => Service::where('is_active', true)
                ->distinct()
                ->pluck('category'),
        ]);
    }
}

