<?php

namespace Tests\Unit;

use App\Models\Banner;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_has_a_banner()
    {
        $user = User::factory()->create();
        $banner = Banner::factory()->create(['user_id' => $user->id]);
        $this->assertEquals($banner->id, $user->banner->id);
    }
}
