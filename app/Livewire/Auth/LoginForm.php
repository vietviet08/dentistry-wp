<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginForm extends Component
{
    #[Validate('required|email')]
    public string $email = '';
    
    #[Validate('required')]
    public string $password = '';
    
    public bool $remember = false;
    public bool $showPassword = false;

    public function login()
    {
        $this->validate();

        // Rate limiting
        $key = 'login:' . request()->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'email' => __('Too many login attempts. Please try again in :seconds seconds.', [
                    'seconds' => RateLimiter::availableIn($key)
                ])
            ]);
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($key, 60);
            
            throw ValidationException::withMessages([
                'email' => __('These credentials do not match our records.')
            ]);
        }

        RateLimiter::clear($key);
        
        session()->regenerate();
        
        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}

