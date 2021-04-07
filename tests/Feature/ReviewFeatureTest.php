<?php

namespace Tests\Feature;

use App\Models\Commission;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function they_are_visible()
    {
        $review = Review::factory()->create();
        $this->get('/reviews/' . $review->id)
            ->assertSuccessful();
    }
    /** @test */
    public function it_can_create_reviews()
    {
        $buyer = User::factory()->create();
        $commission = Commission::factory()->create(['buyer_id' => $buyer->id, 'status' => 'Archived']);
        $this->actingAs($buyer)
            ->get('/reviews/create/' . $commission->id)
            ->assertSuccessful();

        $this->actingAs($buyer)
            ->post('/reviews/create/' . $commission->id, [
                'positive' => 1,
                'anonymous' => 1
            ])
            ->assertRedirect('/reviews/1')
            ->assertSessionHas('success');

        $this->assertDatabaseCount('reviews', 1);
    }
}
