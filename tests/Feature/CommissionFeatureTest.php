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
        [$buyer, $seller] = $this->createBuyerAndSeller();

        $commission = Commission::factory()->create(['buyer_id'=>$buyer->id, 'creator_id'=>$seller->id]);

        $this->assertEquals('Unpaid', $commission->status);
    }
}
