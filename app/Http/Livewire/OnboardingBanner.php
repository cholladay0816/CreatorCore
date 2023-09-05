<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class OnboardingBanner extends Component
{
    public function dismiss()
    {
        Session::put('onboarding_dismissed', true);
    }

    public function render()
    {
        return view('livewire.onboarding-banner');
    }
}
