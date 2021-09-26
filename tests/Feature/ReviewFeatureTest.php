<?php

namespace Tests\Feature;

use App\Models\Commission;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function they_are_visible()
    {
        $review = Review::factory()->create();

        $this->get(route('reviews.show', $review))
            ->assertSuccessful();
    }

    /** @test */
    public function owner_can_view_anonymous_review()
    {
        $review = Review::factory()->create(['anonymous' => 1]);

        $this->actingAs($review->user)
            ->get(route('reviews.show', $review))
            ->assertSuccessful();
    }
    /** @test */
    public function guest_cannot_view_anonymous_review()
    {
        $review = Review::factory()->create(['anonymous' => 1]);

        $this->get(route('reviews.show', $review))
            ->assertNotFound();
    }
    /** @test */
    public function it_can_create_reviews()
    {
        $buyer = User::factory()->create();
        $commission = Commission::factory()->create(['buyer_id' => $buyer->id, 'status' => 'Archived']);
        $this->actingAs($buyer)
            ->get(route('reviews.create', $commission->fresh()))
            ->assertSuccessful();

        $this->actingAs($buyer)
            ->post(route('reviews.store', $commission), [
                'positive' => 1,
                'anonymous' => 1
            ])
            ->assertRedirect(route('reviews.show', '1'))
            ->assertSessionHas('success');

        $this->assertDatabaseCount('reviews', 1);
    }
    /** @test */
    public function it_can_be_deleted()
    {
        $review = Review::factory()->create();

        $this->actingAs($review->user)
            ->delete(route('reviews.destroy', $review));

        $this->assertNull($review->fresh());
    }
}
