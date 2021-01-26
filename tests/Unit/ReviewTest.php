<?php

namespace Tests\Unit;

use App\Models\Attachment;
use App\Models\Commission;
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

        $this->assertEquals($review->owner->id, $user->id);
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
}
