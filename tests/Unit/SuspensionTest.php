<?php

namespace Tests\Unit;

use App\Models\Suspension;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuspensionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $user = User::factory()->create();
        $suspension = Suspension::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($suspension->user->id, $user->id);
    }

    /** @test */
    public function users_can_be_suspended()
    {
        $user = User::factory()->create();

        $this->assertFalse($user->suspended());

        Suspension::factory()->create(['user_id' => $user->id, 'expires_at' => now()->addDays(7)]);
        $this->assertTrue($user->fresh()->suspended());
    }
}
