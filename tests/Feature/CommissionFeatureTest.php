<?php

namespace Tests\Feature;

use App\Models\Attachment;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Cashier\Exceptions\PaymentFailure;
use Stripe\Card;
use Stripe\Exception\CardException;
use Tests\TestCase;

class CommissionFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function createBuyerAndSeller()
    {
        $buyer = User::factory()->create();
        $seller = User::factory()->create();
        return [$buyer, $seller];
    }

    /** @test */
    public function a_commission_can_be_created()
    {
        // Generate a buyer and seller
        [$buyer, $seller] = $this->createBuyerAndSeller();

        // Make a working commission
        $commission = Commission::factory()->make([
            'buyer_id'=>$buyer->id,
            'creator_id'=>$seller->id
        ]);
        $commission->memo = 'Test Memo';

        // As the buyer, visit the create commission page
        $this->actingAs($buyer)
            ->get(route('commissions.create', [$seller, $commission->preset]))
            ->assertOk();

        // As the buyer, submit a POST using the commission as form data.
        $res = $this->actingAs($buyer)
            ->post(
                route('commissions.store', [$seller, $commission->preset]),
                $commission->attributesToArray()
            )
            ->assertSessionHas(['success' => 'Commission created successfully']);

        // Grab a fresh copy of our commission
        $commission = Commission::where('memo', 'Test Memo')->firstOrFail();

        // Assert that we redirect back to the commission show page.
        $res->assertRedirect('/commissions/' . $commission->getSlug());

    }

    // TODO: test to make sure unauthorized users (logged in or otherwise) cannot view.
    /** @test */
    public function a_commission_cannot_be_viewed_by_guests()
    {
        $commission = Commission::factory()->create();
        $this->get(route('commissions.show', $commission))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_commission_cannot_be_viewed_by_third_parties()
    {
        $commission = Commission::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('commissions.show', $commission))
            ->assertNotFound();
    }

    /** @test */
    public function a_commission_can_be_deleted()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Unpaid'
        ]);
        $this->actingAs($buyer)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertSessionHas('success', 'Commission deleted')
            ->assertRedirect(route('commissions.orders'));

        $this->assertNull($commission->fresh());
    }

    /** @test */
    public function a_commission_can_be_declined()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Pending'
        ]);
        $this->actingAs($seller)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertSessionHas('success', 'Commission declined')
            ->assertRedirect(route('commissions.index'));

        $this->assertEquals('Declined', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_be_accepted()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Pending'
        ]);
        $this->actingAs($seller)
            ->put(route('commissions.update', $commission->fresh()))
            ->assertSessionHas('success', 'Commission accepted')
            ->assertRedirect(route('commissions.index'));

        $this->assertEquals('Purchasing', $commission->fresh()->status);
    }

    // TODO: test for paying for commission
    /** @test */
    public function a_commission_can_be_paid_for()
    {
        // Create our buyer and seller
        [$buyer, $seller] = $this->createBuyerAndSeller();

        // Make the buyer a Stripe customer
        $buyer->createAsStripeCustomer();

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
        $paymentmethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 2,
                'exp_year' => 2022,
                'cvc' => '123',
            ],
        ]);
        // Attach it to the customer
        $stripe->paymentMethods->attach(
            $paymentmethod->id,
            ['customer' => $buyer->stripe_id],
        );
        // Make this payment method their default
        $stripe->customers->update(
            $buyer->stripe_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $paymentmethod->id,
                ],
            ],
        );
        // Attempt to charge the customer with an invoice.
        $invoice = $commission->attemptCharge();

        // Assert the customer cannot be billed twice.
        $this->assertNull($commission->attemptCharge());

        // Check the commission to see if the invoice is paid.
        // TESTING ONLY, not live implementation.  Refer to Webhooks.
        $commission->checkInvoiceStatus();

        // Assert the commission is Pending after being paid for.
        $this->assertEquals('Pending', $commission->status);

    }
    /** @test */
    public function a_commission_can_fail_payment()
    {
        // Create our buyer and seller
        [$buyer, $seller] = $this->createBuyerAndSeller();

        // Make the buyer a Stripe customer
        $buyer->createAsStripeCustomer();

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
        $paymentmethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => '4000000000000341',
                'exp_month' => 2,
                'exp_year' => 2022,
                'cvc' => '123',
            ],
        ]);
        // Attach it to the customer
        $stripe->paymentMethods->attach(
            $paymentmethod->id,
            ['customer' => $buyer->stripe_id],
        );
        // Make this payment method their default
        $stripe->customers->update(
            $buyer->stripe_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $paymentmethod->id,
                ],
            ],
        );
        // We know this card will fail, so we expect an exception message.
        // Attempt to charge the customer with an invoice.
        $invoice = $commission->attemptCharge();

        $this->assertEquals(PaymentFailure::class, get_class($invoice));
    }

    /** @test */
    public function a_commission_can_not_be_completed_without_attachments()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        // Create an active commission
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Active'
        ]);
        // Attempt to complete the order
        $this->actingAs($seller)
            ->put(route('commissions.update', $commission->fresh()))
            // Assert that this attempt to complete the order failed, as we do not have an attachment.
            ->assertStatus(401);
    }

    /** @test */
    public function a_commission_can_be_completed()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        // Create an active commission
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Active'
        ]);
        // Create an attachment, one is needed to complete the order
        Attachment::factory()->create([
            'commission_id' => $commission->id,
            'user_id' => $seller->id
        ]);
        // Put an update to cycle the commission into completion.
        $this->actingAs($seller)
            ->put(route('commissions.update', $commission->fresh()))
            // Assert the session contains a success field
            ->assertSessionHas('success', 'Commission completed')
            // Assert we are redirected back to the commission list
            ->assertRedirect(route('commissions.index'));

        // Assert that the commission is completed
        $this->assertEquals('Completed', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_be_disputed()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Completed'
        ]);
        $this->actingAs($buyer)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertSessionHas('success', 'Commission disputed')
            ->assertRedirect(route('commissions.orders'));

        $this->assertEquals('Disputed', $commission->fresh()->status);
    }

    // TODO: test for resolving commission

    // TODO: test for refunding commission

    /** @test */
    public function a_commission_can_be_expired()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Active',
            'expiration_date' => now()
        ]);
        $this->actingAs($buyer)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertSessionHas('success', 'Commission canceled')
            ->assertRedirect(route('commissions.orders'));

        $this->assertEquals('Expired', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_be_archived()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Completed'
        ]);
        $this->actingAs($buyer)
            ->put(route('commissions.update', $commission->fresh()))
            ->assertSessionHas('success', 'Commission archived')
            ->assertRedirect(route('commissions.orders'));

        $this->assertEquals('Archived', $commission->fresh()->status);
    }
}
