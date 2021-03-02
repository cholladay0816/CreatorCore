<?php

namespace Tests;

use App\Models\Commission;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Stripe\StripeClient;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function tearDown(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->stripe_id) {
                $stripe = new StripeClient(config('stripe.secret'));
                $stripe->customers->delete($user->stripe_id);
            }
            if ($user->stripe_account_id) {
                $stripe = new StripeClient(config('stripe.secret'));
                $stripe->accounts->delete($user->stripe_account_id);
            }
        }

        parent::tearDown();
    }
}
