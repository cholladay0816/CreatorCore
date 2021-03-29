<?php

namespace Tests\Unit;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_an_owner()
    {
        $user = User::factory()->create();
        $gallery = Gallery::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $gallery->user->id);
    }
}
