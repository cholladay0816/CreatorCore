<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Stripe\Exception\ApiErrorException;

class ViewStripeAccount extends Component
{
    public $accountLink;

    public function render()
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret'));

        try {
            $this->accountLink = \Stripe\Account::createLoginLink(
                auth()->user()->stripe_account_id,
            )->url;
        } catch (ApiErrorException $e) {
        }
        return view('livewire.profile.view-stripe-account');
    }
}
