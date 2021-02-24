<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_all_notifications()
    {
        $user = User::factory()->create();
        $notifications = Notification::factory(3)->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get(route('notifications.index'));

        foreach ($notifications as $notification) {
            $response->assertSee($notification->title);
        }
    }

    /** @test */
    public function it_shows_one_notification()
    {
        $user = User::factory()->create();
        $notification = Notification::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
                         ->get(route('notifications.show', $notification));

        $response->assertSee($notification->title)
                 ->assertSee($notification->description);
    }

    /** @test */
    public function it_can_be_read()
    {
        $user = User::factory()->create();
        $notification = Notification::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->put(route('notifications.update', $notification));

        $this->assertNotNull($notification->fresh()->read_at);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $user = User::factory()->create();
        $notification = Notification::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete(route('notifications.update', $notification));

        $this->assertNull($notification->fresh());
    }
}
