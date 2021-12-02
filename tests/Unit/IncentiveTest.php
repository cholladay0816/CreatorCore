<?php

namespace Tests\Unit;

use App\Models\Bonus;
use App\Models\Commission;
use App\Models\Incentive;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncentiveTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function a_user_has_an_incentive() {
        $user = User::factory()->create();

        Incentive::factory()->create(['amount' => 10000, 'user_id' => $user->id]);

        $this->assertEquals(10000, $user->incentive);
    }

    /** @test */
    function an_incentive_can_increase() {

        $user = User::factory()->create();

        Incentive::factory()->create(['amount' => 10000, 'user_id' => $user->id]);

        $this->assertEquals(10000, $user->incentive);

        Incentive::factory()->create(['amount' => 10000, 'user_id' => $user->id]);

        $this->assertEquals(20000, $user->fresh()->incentive);
    }

    /** @test */
    function an_incentive_can_decrease() {
        $user = User::factory()->create();

        Incentive::factory()->create(['amount' => 10000, 'user_id' => $user->id]);

        $this->assertEquals(10000, $user->incentive);

        Bonus::factory()->create([
            'amount' => 10000,
            'user_id' => $user->id,
            'commission_id' => Commission::factory()->create()->id
        ]);

        $this->assertEquals(0, $user->fresh()->incentive);
    }
}
