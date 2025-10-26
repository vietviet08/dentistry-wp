<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class ServiceTable extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $showModal = false;
    public $serviceId = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function toggleActive($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $service->update(['is_active' => !$service->is_active]);
        session()->flash('success', 'Service status updated.');
    }

    public function deleteService($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $service->delete();
        session()->flash('success', 'Service deleted successfully.');
    }

    public function render()
    {
        $services = Service::withCount('appointments')
            ->when($this->search, fn($query) => 
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
            )
            ->when($this->categoryFilter, fn($query) => 
                $query->where('category', $this->categoryFilter)
            )
            ->latest()
            ->paginate(15);

        $categories = Service::distinct('category')->pluck('category');

        return view('livewire.admin.services.service-table', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }
}

