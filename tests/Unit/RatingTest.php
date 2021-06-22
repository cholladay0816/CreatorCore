<?php

namespace Tests\Unit;

use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function it_has_a_review()
    {
        $review = Review::factory()->create();
        $rating = Rating::factory()->create(['review_id' => $review->id]);
        $this->assertEquals($review->id, $rating->review->id);
    }
    /** @test */
    public function it_has_a_user()
    {
        $user = User::factory()->create();
        $rating = Rating::factory()->create(['user_id' => $user->id]);
        $this->assertEquals($user->id, $rating->user->id);
    }
}
