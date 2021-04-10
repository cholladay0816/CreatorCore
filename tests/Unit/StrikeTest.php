<?php

namespace Tests\Unit;

use App\Models\Strike;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StrikeTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_has_a_user()
    {
        $user = User::factory()->create();
        $strike = Strike::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($strike->user->id, $user->id);
    }

    /** @test */
    public function users_can_have_strikes()
    {
        $user = User::factory()->create();

        $this->assertCount(0, $user->strikes);

        Strike::factory()->create(['user_id' => $user->id, 'expires_at' => now()->addDays(7)]);
        $this->assertCount(1, $user->fresh()->strikes);
    }
    /** @test */
    public function it_suspends_after_three_strikes()
    {
        $user = User::factory()->create();

        // Make sure user is not suspended
        $this->assertFalse($user->suspended());

        // Create 3 strikes
        Strike::factory(3)->create(['user_id' => $user->id, 'expires_at' => now()->addDays(7)]);

        // Assert the user was suspended
        $this->assertTrue($user->fresh()->suspended());

        // Assert the strikes can no longer suspend the user
        $this->assertEmpty($user->fresh()->strikes->where('expires_at', '>', now()));
    }
}
