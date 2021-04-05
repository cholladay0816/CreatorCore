<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class PaymentDetails extends Component
{
    public function render()
    {
        return view('livewire.profile.payment-details');
    }
    public function portal()
    {
        auth()->user()->createOrGetStripeCustomer();
        $this->redirect(
            auth()->user()->billingPortalUrl(route('profile.show'))
        );
    }
}
