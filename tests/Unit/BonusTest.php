<?php

namespace Tests\Unit;

use App\Models\Bonus;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BonusTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_bonus_has_a_user()
    {
        $user = User::factory()->create();
        $bonus = Bonus::factory()
            ->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $bonus->user->id);
    }

    /** @test */
    public function a_bonus_has_a_commission()
    {
        $commission = Commission::factory()->create();
        $bonus = Bonus::factory()
            ->create(['commission_id' => $commission->id]);

        $this->assertEquals($commission->id, $bonus->commission->id);
    }
}
