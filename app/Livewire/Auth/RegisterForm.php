<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';
    
    #[Validate('required|email|unique:users,email')]
    public string $email = '';
    
    #[Validate('required|string|min:8')]
    public string $password = '';
    
    #[Validate('required|same:password')]
    public string $password_confirmation = '';
    
    #[Validate('nullable|string|max:20')]
    public string $phone = '';
    
    #[Validate('accepted')]
    public bool $agreeToTerms = false;
    
    public bool $showPassword = false;
    public bool $showConfirmPassword = false;

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone ?: null,
            'role' => 'patient',
        ]);

        event(new Registered($user));
        
        Auth::login($user);
        
        session()->regenerate();
        
        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}

