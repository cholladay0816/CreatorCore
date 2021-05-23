<?php

namespace Tests\Unit;

use App\Models\Attachment;
use App\Models\Commission;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Review;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_review_has_an_owner()
    {
        $user = User::factory()->create();
        $review = Review::factory()->create(['user_id'=>$user->id]);

        $this->assertEquals($review->user->id, $user->id);
    }
    /** @test */
    public function a_review_has_a_commission()
    {
        $commission = Commission::factory()->create();
        $review = Review::factory()->create(['commission_id'=>$commission->id]);

        $this->assertEquals($review->commission->id, $commission->id);
    }
    /** @test */
    public function a_review_can_have_an_attachment()
    {
        $commission = Commission::factory()->create();
        $attachment = Attachment::factory()->create(['commission_id'=>$commission->id]);
        $review = Review::factory()->create(['attachment_id'=>$attachment->id]);
        $this->assertEquals($review->attachment->id, $attachment->id);

        $attachment->delete();

        $this->assertNull($review->fresh()->attachment);
    }

    /** @test */
    public function a_user_can_have_reviews()
    {
        $creator = User::factory()->create();
        $buyer = User::factory()->create();
        $commission = Commission::factory()->create(
            [
                'status' => 'Archived',
                'buyer_id' => $buyer->id,
                'creator_id' => $creator
            ]
        );
        $review = Review::factory()->create(['commission_id' => $commission->id, 'user_id' => $buyer->id, 'positive' => 1]);

        $this->assertCount(1, $creator->ratings);
    }
    /** @test */
    public function a_user_can_have_a_rating()
    {
        $creator = User::factory()->create();
        $buyer = User::factory()->create();
        $commission = Commission::factory()->create(
            [
                'status' => 'Archived',
                'buyer_id' => $buyer->id,
                'creator_id' => $creator
            ]
        );
        $review = Review::factory()->create(['commission_id' => $commission->id, 'user_id' => $buyer->id, 'positive' => 1]);
        $review = Review::factory()->create(['commission_id' => $commission->id, 'user_id' => $buyer->id, 'positive' => 1]);
        $review = Review::factory()->create(['commission_id' => $commission->id, 'user_id' => $buyer->id, 'positive' => 1]);
        $review = Review::factory()->create(['commission_id' => $commission->id, 'user_id' => $buyer->id, 'positive' => 0]);

        $this->assertEquals(0.75, $creator->rating);
    }

    /** @test */
    public function a_user_can_have_a_star_rating()
    {
        $creator = User::factory()->create();
        $buyer = User::factory()->create();
        $commission = Commission::factory()->create(
            [
                'status' => 'Archived',
                'buyer_id' => $buyer->id,
                'creator_id' => $creator
            ]
        );
        Review::factory(3)->create(['commission_id' => $commission->id, 'user_id' => $buyer->id, 'positive' => 1]);
        $this->assertEquals(5.0, $creator->fresh()->stars);
        Review::factory(2)->create(['commission_id' => $commission->id, 'user_id' => $buyer->id, 'positive' => 0]);
        $this->assertEquals(3.0, $creator->fresh()->stars);
    }

    /** @test */
    public function it_can_have_ratings()
    {
        $review = Review::factory()->create();
        $rating = Rating::factory()->create(['review_id' => $review->id]);
        // Assert the rating is attached to the review
        $this->assertEquals($rating->id, $review->ratings->first()->id);
        // Create a new rating
        Rating::factory()->create(['review_id' => $review->id]);
        // Assert there are two ratings on this review
        $this->assertCount(2, $review->fresh()->ratings);
    }

    /** @test */
    public function it_can_have_a_score()
    {
        $review = Review::factory()->create();
        Rating::factory()->create(['review_id' => $review->id, 'positive' => 1]);
        Rating::factory()->create(['review_id' => $review->id, 'positive' => 0]);
        $this->assertEquals(0.5, $review->rating);
    }
}
