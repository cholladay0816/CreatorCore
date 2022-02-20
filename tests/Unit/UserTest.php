<?php

namespace Tests\Unit;

use App\Models\Banner;
use App\Models\Creator;
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
    /** @test */
    public function names_are_unique()
    {
        $user1 = User::factory()->create(['name' => 'Test']);
        $this->expectError();
        $user2 = User::factory()->create(['name' => 'Test']);
    }
    /** @test */
    public function it_has_a_creator()
    {
        $user = User::factory()->create();
        $creator = $user->creator;
        $this->assertEquals(get_class($creator), Creator::class);
        $this->assertEquals($user->creator->id, $creator->id);
    }
}
