<?php

namespace App\Livewire\Admin\Doctors;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.admin')]
class DoctorForm extends Component
{
    use WithFileUploads;

    public $doctorId = null;
    public $name = '';
    public $slug = '';
    public $specialization = '';
    public $qualification = '';
    public $experience_years = 0;
    public $bio = '';
    public $email = '';
    public $phone = '';
    public $consultation_fee = 0;
    public $is_available = true;
    public $order = 0;
    public $photo;
    public $photoPreview;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('doctors', 'slug')->ignore($this->doctorId)
            ],
            'specialization' => 'required|string|max:255',
            'qualification' => 'required|string',
            'experience_years' => 'required|integer|min:0',
            'bio' => 'required|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'consultation_fee' => 'required|numeric|min:0',
            'is_available' => 'boolean',
            'order' => 'integer',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    public function mount($doctor = null)
    {
        if ($doctor) {
            // Resolve doctor ID if it's a string
            $doctorId = is_string($doctor) ? $doctor : $doctor->id;
            $this->doctorId = $doctorId;
            
            $doctor = Doctor::findOrFail($doctorId);
            $this->name = $doctor->name;
            $this->slug = $doctor->slug;
            $this->specialization = $doctor->specialization;
            $this->qualification = $doctor->qualification;
            $this->experience_years = $doctor->experience_years;
            $this->bio = $doctor->bio;
            $this->email = $doctor->email;
            $this->phone = $doctor->phone;
            $this->consultation_fee = $doctor->consultation_fee;
            $this->is_available = $doctor->is_available;
            $this->order = $doctor->order;
            $this->photoPreview = $doctor->photo;
        }
    }

    public function updatedName()
    {
        if (!$this->doctorId) {
            $this->slug = \Str::slug($this->name);
        }
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->doctorId) {
            $doctor = Doctor::findOrFail($this->doctorId);
        } else {
            $doctor = new Doctor();
        }

        $doctor->name = $validated['name'];
        $doctor->slug = $validated['slug'];
        $doctor->specialization = $validated['specialization'];
        $doctor->qualification = $validated['qualification'];
        $doctor->experience_years = $validated['experience_years'];
        $doctor->bio = $validated['bio'];
        $doctor->email = $validated['email'];
        $doctor->phone = $validated['phone'];
        $doctor->consultation_fee = $validated['consultation_fee'];
        $doctor->is_available = $validated['is_available'];
        $doctor->order = $validated['order'];

        if ($this->photo) {
            $doctor->photo = $this->photo->store('doctors', 'public');
        }

        $doctor->save();

        session()->flash('success', 'Doctor saved successfully!');
        return redirect()->route('admin.doctors.index');
    }

    public function render()
    {
        return view('livewire.admin.doctors.doctor-form');
    }
}

