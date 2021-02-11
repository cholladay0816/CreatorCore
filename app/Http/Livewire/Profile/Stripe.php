<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Stripe extends Component
{
    public function render()
    {
        auth()->user()->fetchStripeAccount();
        return view('livewire.profile.stripe');
    }
}
