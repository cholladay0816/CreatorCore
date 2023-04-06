<?php

namespace Tests;

use App\Models\Commission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Stripe\BaseStripeClient;
use Stripe\StripeClient;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use RefreshDatabase;
    use WithFaker;

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
    public function createBuyerAndSeller($payment = false)
    {
        $buyer = User::factory()->create();
        $seller = User::factory()->create();
        $seller->creator->fill(['open' => true, 'allows_custom_commissions' => true])->save();

        if ($payment) {
            $buyer->createOrGetStripeCustomer();

            $stripe = new StripeClient(config('stripe.secret'));
            $account = $stripe->accounts->create([
                'country' => 'US',
                'type' => 'custom',
                'email' => $seller->email,
                'business_type' => 'individual',
                'capabilities' => [
                    'transfers' => ['requested' => true],
                ],
                'external_account' => [
                    'object' => 'bank_account',
                    'country' => 'us',
                    'currency' => 'usd',
                    'routing_number'=>'110000000',
                    'account_number' => '000123456789'
                ],
                'individual' => [

                    'id_number' => '000000000',
                    'ssn_last_4' => '0000',

                    'address' => [
                        'city' =>'Schenectady',
                        'line1' =>'123 State St',
                        'postal_code' => '12345',
                        'country' =>'US',
                        'state' => 'NY',
                    ],
                    'dob' => [
                        'day' => '10',
                        'month' => '11',
                        'year' => '1980',
                    ],
                    'email' => $seller->email,
                    'first_name' => $this->faker->firstName,
                    'last_name' => $this->faker->lastName,
                    'gender' => (random_int(0, 1)==1 ? 'male' : 'female'),
                    'phone' => $this->faker->phoneNumber,
                ],
                'tos_acceptance' => [
                    'date' => now()->unix(),
                    'ip' => $this->faker->ipv4,
                    'user_agent' => $seller->name,
                ],
                'business_profile' => [
                    'mcc' => '7333',
                    'url' => 'https://creator-core.com',
                ]

            ]);
            $seller->stripe_account_id = $account->id;
            $seller->save();

            // Create a payment method
            $paymentMethod = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => 2,
                    'exp_year' => now()->addYears(2)->year,
                    'cvc' => '123',
                ],
            ]);
            // Attach it to the customer
            $stripe->paymentMethods->attach(
                $paymentMethod->id,
                ['customer' => $buyer->stripe_id],
            );
            // Make this payment method their default
            $stripe->customers->update(
                $buyer->stripe_id,
                [
                    'invoice_settings' => [
                        'default_payment_method' => $paymentMethod->id,
                    ],
                ],
            );
        }

        return [$buyer, $seller];
    }


    public function getChargedCommission($buyer, User $seller)
    {
        $buyer->createOrGetStripeCustomer();

        $stripe = new StripeClient(config('stripe.secret'));

        $account = $stripe->accounts->create([
            'country' => 'US',
            'type' => 'custom',
            'email' => $seller->email,
            'business_type' => 'individual',
            'capabilities' => [
                'transfers' => ['requested' => true],
            ],
            'external_account' => [
                'object' => 'bank_account',
                'country' => 'us',
                'currency' => 'usd',
                'routing_number'=>'110000000',
                'account_number' => '000123456789'
            ],
            'individual' => [

                'id_number' => '000000000',
                'ssn_last_4' => '0000',

                'address' => [
                    'city' =>'Schenectady',
                    'line1' =>'123 State St',
                    'postal_code' => '12345',
                    'country' =>'US',
                    'state' => 'NY',
                ],
                'dob' => [
                    'day' => '10',
                    'month' => '11',
                    'year' => '1980',
                ],
                'email' => $seller->email,
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'gender' => (random_int(0, 1)==1 ? 'male' : 'female'),
                'phone' => $this->faker->phoneNumber,
            ],
            'tos_acceptance' => [
                'date' => now()->unix(),
                'ip' => $this->faker->ipv4,
                'user_agent' => $seller->name,
            ],
            'business_profile' => [
                'mcc' => '7333',
                'url' => 'https://creator-core.com',
            ]

        ]);
        $seller->stripe_account_id = $account->id;
        $seller->save();

        // Create the commission
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Unpaid'
        ]);
        // Initialize Stripe
        $stripe = new \Stripe\StripeClient(
            config('stripe.secret'),
        );
        // Create a payment method
        $paymentMethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 2,
                'exp_year' => now()->addYears(2)->year,
                'cvc' => '123',
            ],
        ]);
        // Attach it to the customer
        $stripe->paymentMethods->attach(
            $paymentMethod->id,
            ['customer' => $buyer->stripe_id],
        );
        // Make this payment method their default
        $stripe->customers->update(
            $buyer->stripe_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $paymentMethod->id,
                ],
            ],
        );
        // Attempt to charge the customer with an invoice.
        $commission->attemptCharge();

        return $commission->fresh();
    }
}
