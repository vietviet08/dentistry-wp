<?php

namespace App\Livewire\Patient\Profile;

use App\Models\User;
use App\Services\FileUploadService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class ProfileEdit extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $date_of_birth;
    public $avatar;
    public $avatarPreview;
    
    protected $originalEmail;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'avatar' => 'nullable|image|max:2048',
        ];
        
        // Only validate email uniqueness if email has changed
        if ($this->email !== $this->originalEmail) {
            $rules['email'] = ['required', 'email', \Illuminate\Validation\Rule::unique('users', 'email')->ignore(auth()->id())];
        } else {
            $rules['email'] = 'required|email';
        }
        
        return $rules;
    }

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->originalEmail = $user->email; // Store original email
        $this->phone = $user->phone;
        $this->date_of_birth = $user->date_of_birth?->format('Y-m-d');
        $this->avatarPreview = $user->avatar;
    }

    public function updated($propertyName)
    {
        // Don't validate email if it hasn't changed
        if ($propertyName === 'email') {
            if ($this->email === $this->originalEmail) {
                $this->resetErrorBag('email');
                $this->resetValidation('email');
                return;
            }
        }
        
        // Skip validation for other fields if only avatar is being uploaded
        if ($propertyName === 'avatar') {
            return;
        }
        
        $this->validateOnly($propertyName);
    }
    
    public function updatedEmail()
    {
        // Clear any existing errors when email changes
        $this->resetErrorBag('email');
        $this->resetValidation('email');
        
        // Only validate if email actually changed
        if ($this->email !== $this->originalEmail) {
            $this->validateOnly('email');
        }
    }

    public function save()
    {
        // Force clear email validation errors if email hasn't changed
        if ($this->email === $this->originalEmail) {
            $this->resetErrorBag('email');
            $this->resetValidation('email');
        }
        
        // Use custom validation that skips email uniqueness if unchanged
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'avatar' => 'nullable|image|max:2048',
        ];
        
        // Only validate email uniqueness if it changed
        if ($this->email !== $this->originalEmail) {
            $rules['email'] = ['required', 'email', \Illuminate\Validation\Rule::unique('users', 'email')->ignore(auth()->id())];
        } else {
            $rules['email'] = 'required|email';
        }
        
        $this->validate($rules);

        $user = auth()->user();
        
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
        ];

        if ($this->avatar) {
            // Delete old avatar if exists
            if ($user->avatar) {
                $fileUploadService = app(FileUploadService::class);
                $fileUploadService->deleteFile($user->avatar);
            }
            
            // Store the uploaded avatar
            $fileUploadService = app(FileUploadService::class);
            $data['avatar'] = $fileUploadService->uploadAvatar($this->avatar);
            $this->avatarPreview = $data['avatar'];
        }

        $user->update($data);
        
        // Update original email after successful save
        $this->originalEmail = $this->email;

        session()->flash('success', 'Profile updated successfully!');
        
        // Reset avatar property to allow new uploads
        $this->avatar = null;
        
        // Clear all validation errors after successful save
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.patient.profile.profile-edit');
    }
}
