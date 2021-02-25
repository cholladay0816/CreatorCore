<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class PaymentDetails extends Component
{
    public $customerLink;
    public function render()
    {
        auth()->user()->createOrGetStripeCustomer();
        $this->customerLink = auth()->user()->billingPortalUrl(route('profile.show'));
        return view('livewire.profile.payment-details');
    }
}
