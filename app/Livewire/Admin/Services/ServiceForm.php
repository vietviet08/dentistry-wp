<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.admin')]
class ServiceForm extends Component
{
    use WithFileUploads;

    public $serviceId = null;
    public $name = '';
    public $slug = '';
    public $category = 'general';
    public $description = '';
    public $duration = 30;
    public $price = 0;
    public $is_active = true;
    public $order = 0;
    public $icon = '';
    public $meta_title = '';
    public $meta_description = '';
    public $image;
    public $imagePreview;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('services', 'slug')->ignore($this->serviceId)
            ],
            'category' => 'required|in:general,cosmetic,orthodontics,surgery,emergency,pediatric',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'order' => 'integer',
            'icon' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function mount($service = null)
    {
        if ($service) {
            // Resolve service ID if it's a string
            $serviceId = is_string($service) ? $service : $service->id;
            $this->serviceId = $serviceId;
            
            $service = Service::findOrFail($serviceId);
            $this->name = $service->name;
            $this->slug = $service->slug;
            $this->category = $service->category;
            $this->description = $service->description;
            $this->duration = $service->duration;
            $this->price = $service->price;
            $this->is_active = $service->is_active;
            $this->order = $service->order;
            $this->icon = $service->icon;
            $this->meta_title = $service->meta_title;
            $this->meta_description = $service->meta_description;
            $this->imagePreview = $service->image;
        }
    }

    public function updatedName()
    {
        if (!$this->serviceId) {
            $this->slug = \Str::slug($this->name);
        }
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->serviceId) {
            $service = Service::findOrFail($this->serviceId);
        } else {
            $service = new Service();
        }

        $service->name = $validated['name'];
        $service->slug = $validated['slug'];
        $service->category = $validated['category'];
        $service->description = $validated['description'];
        $service->duration = $validated['duration'];
        $service->price = $validated['price'];
        $service->is_active = $validated['is_active'];
        $service->order = $validated['order'];
        $service->icon = $validated['icon'];
        $service->meta_title = $validated['meta_title'];
        $service->meta_description = $validated['meta_description'];

        if ($this->image) {
            $service->image = $this->image->store('services', 'public');
        }

        $service->save();

        session()->flash('success', 'Service saved successfully!');
        return redirect()->route('admin.services.index');
    }

    public function render()
    {
        return view('livewire.admin.services.service-form');
    }
}

