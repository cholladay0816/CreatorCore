<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Stripe extends Component
{
    public $onboarded;

    public function render()
    {
        $this->onboarded = auth()->user()->isOnboarded();
        return view('livewire.profile.stripe');
    }
}
