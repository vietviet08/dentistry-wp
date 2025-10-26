<?php

namespace App\Livewire\Patient\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $date_of_birth;
    public $avatar;
    public $avatarPreview;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'nullable|string|max:20',
        'date_of_birth' => 'nullable|date',
        'avatar' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->date_of_birth = $user->date_of_birth?->format('Y-m-d');
        $this->avatarPreview = $user->avatar;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
        if ($propertyName === 'email') {
            $this->rules['email'] = 'required|email|unique:users,email,' . auth()->id();
        }
    }

    public function save()
    {
        $this->validate();

        $user = auth()->user();
        
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
        ];

        if ($this->avatar) {
            // Store the uploaded avatar
            $path = $this->avatar->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        session()->flash('success', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.patient.profile.profile-edit');
    }
}
