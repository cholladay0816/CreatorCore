<?php

namespace Tests\Unit;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_message_has_a_sender()
    {
        $user = User::factory()->create();
        $message = Message::factory()->create(['sender_id' => $user->id]);

        $this->assertEquals($message->sender->id, $user->id);
    }

    /** @test */
    public function a_message_has_a_receiver()
    {
        $user = User::factory()->create();
        $message = Message::factory()->create(['receiver_id' => $user->id]);

        $this->assertEquals($message->receiver->id, $user->id);
    }

    /** @test */
    public function a_message_has_content()
    {
        // Create a message with the content 'Test'
        $message = Message::factory()->create(['message' => 'Test']);

        // Assert this content is set
        $this->assertEquals('Test', $message->message);
    }

    /** @test */
    public function a_message_can_be_read()
    {
        $message = Message::factory()->create();

        // Assert message has not been read, therefore read at date is null
        $this->assertNull($message->read_at);

        // Message has been read
        $message->read();

        // Assert read at date is no longer null
        $this->assertNotNull($message->fresh()->read_at);
    }
}
