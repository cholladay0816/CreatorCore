<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Stripe\Exception\ApiErrorException;

class Stripe extends Component
{
    public $onboarded;

    public function render()
    {
        $this->onboarded = auth()->user()->isOnboarded();
        return view('livewire.profile.stripe');
    }
    public function connect()
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret'));
        $this->redirect(
            \Stripe\AccountLink::create([
                'account' => auth()->user()->stripe_account_id,
                'refresh_url' => route('profile.show'),
                'return_url' => route('profile.show'),
                'type' => 'account_onboarding',
            ])->url
        );
    }
    public function view()
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret'));

        try {
            $this->redirect(
                \Stripe\Account::createLoginLink(
                    auth()->user()->stripe_account_id,
                )->url
            );
        } catch (ApiErrorException $e) {
        }
    }
}
