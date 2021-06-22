<?php

namespace Tests\Unit;

use App\Models\Banner;
use App\Models\Creator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $user = User::factory()->create();
        $creator = Creator::factory()->Create(['user_id' => $user->id]);
        $this->assertEquals($user->id, $creator->user->id);
    }
    /** @test */
    public function it_can_have_a_null_banner()
    {
        $creator = Creator::factory()->create();
        $this->assertNull($creator->banner);
    }
}
