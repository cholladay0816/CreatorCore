<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class PaymentDetails extends Component
{
    public string|null $redirect = null;
    public function mount()
    {
        if(is_null($this->redirect))
        {
           $this->redirect = route('profile.show');
        }
    }
    public function render()
    {
        return view('livewire.profile.payment-details');
    }
    public function portal()
    {
        auth()->user()->createOrGetStripeCustomer();
        $this->redirect(
            auth()->user()->billingPortalUrl($this->redirect)
        );
    }
}
