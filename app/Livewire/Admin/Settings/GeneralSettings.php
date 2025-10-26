<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class GeneralSettings extends Component
{
    public function render()
    {
        return view('livewire.admin.settings.general-settings');
    }
}

