<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleSwitcher extends Component
{
    public $currentLocale;
    
    public function mount()
    {
        $this->currentLocale = App::getLocale();
    }
    
    public function switchLocale($locale)
    {
        // Validate locale
        if (!in_array($locale, ['vi', 'en'])) {
            return;
        }
        
        // Set session
        Session::put('locale', $locale);
        
        // If user is authenticated, save to user preferences
        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }
        
        $this->currentLocale = $locale;
        
        // Redirect to refresh page with new locale
        return redirect(request()->header('Referer') ?: '/');
    }
    
    public function render()
    {
        return view('livewire.locale-switcher');
    }
}

