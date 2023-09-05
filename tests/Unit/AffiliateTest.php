<?php

namespace Tests\Unit;

use App\Models\Affiliate;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AffiliateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function affiliates_have_a_user()
    {
        # Create an affiliate with a user
        $user = User::factory()->create();
        $affiliate = Affiliate::factory()->create(['user_id' => $user]);

        # Assert that the affiliate's user relationship finds the same user
        $this->assertEquals($user->id, $affiliate->user->id);

        return $affiliate;
    }

    /**
     * @test
     * @depends affiliates_have_a_user
     */
    public function affiliates_have_many_commissions(Affiliate $affiliate)
    {
        # Generate commissions with affiliate ID
        $commissions = Commission::factory(5)->create(['affiliate_id' => $affiliate->id]);

        # Confirm that the affiliate relationship contains all 5 records
        $this->assertCount($commissions->count(), $affiliate->commissions);
    }
}
