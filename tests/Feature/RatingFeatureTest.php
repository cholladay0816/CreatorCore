<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RatingFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_rate_reviews()
    {
        $review = Review::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
        ->post(route('ratings.store', $review), [
            'positive' => '1'
        ]);

        $response->assertStatus(200);

        $this->assertCount(1, $review->ratings);
    }
}
