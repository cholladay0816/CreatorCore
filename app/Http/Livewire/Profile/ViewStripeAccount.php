<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Stripe\Exception\ApiErrorException;

class ViewStripeAccount extends Component
{
    public function render()
    {
        return view('livewire.profile.view-stripe-account');
    }
}
