<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class ConnectWithStripe extends Component
{
    public $accountLink;
    public function render()
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret'));
        $this->accountLink = \Stripe\AccountLink::create([
            'account' => auth()->user()->stripe_account_id,
            'refresh_url' => route('profile.show'),
            'return_url' => route('profile.show'),
            'type' => 'account_onboarding',
        ])->url;
        return view('livewire.profile.connect-with-stripe');
    }
}
