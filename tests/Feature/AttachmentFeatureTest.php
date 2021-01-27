<?php

namespace Tests\Feature;

use App\Models\Attachment;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AttachmentFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_attachment_can_be_added_and_removed_from_commissions()
    {
        Storage::fake('attachments');
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['creator_id' => $user->id]);
        $commission = $commission->fresh();
        $file = UploadedFile::fake()->image('test.png', '64', '64');
        $this->actingAs($user)
            ->post(route('attachments.store', $commission), [
                'file' => $file
            ])
            ->assertSessionHas('success', 'Attachment created')
            ->assertRedirect(route('commissions.show', $commission));
        $this->assertEquals(1, $commission->attachments->count());

        // Assert the file was created
        Storage::assertExists('attachments/' . $file->hashName());
        $attachment = $commission->attachments->first();
        $path = $attachment->path;
        // Delete the attachment
        $attachment->delete();
        // Assert that the file no longer exists
        Storage::assertMissing($path);
        // Assert the attachment is gone
        $this->assertNull($attachment->fresh());
    }
}
