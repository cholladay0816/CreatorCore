<?php

namespace Tests\Feature;

use App\Models\Commission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $commission = Commission::factory()->make(['buyer_id'=>$buyer->id, 'creator_id'=>$seller->id]);
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

    // TODO: test for accepting commission

    // TODO: test for paying for commission

    // TODO: test for payment failing

    // TODO: test for attaching to commission

    // TODO: test for completing commission

    // TODO: test for disputing commission

    // TODO: test for resolving commission

    // TODO: test for refunding commission

    // TODO: test for expiring commission

    // TODO: test for archived commission
}
