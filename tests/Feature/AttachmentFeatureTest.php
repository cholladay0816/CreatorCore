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
    public function an_attachment_cannot_be_uploaded_if_it_is_too_large()
    {
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['creator_id' => $user->id, 'status' => 'Active']);
        $commission = $commission->fresh();
        // Create a dummy image
        $file = UploadedFile::fake()->image('test.png')->size(4097);
        // Attempt to upload this file as an attachment
        $this->actingAs($user)
            ->post(route('attachments.store', $commission), [
                'file' => $file
            ])
            // Assert the file failed to upload.
            ->assertSessionHasErrors();
    }
    /** @test */
    public function an_attachment_cannot_be_uploaded_if_it_is_not_an_image()
    {
        // Create a User and Commission
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['creator_id' => $user->id, 'status' => 'Active']);
        $commission = $commission->fresh();
        // Create a dummy executable
        $file = UploadedFile::fake()->create('test.exe', '1024', 'application/x-msdownload');
        // Attempt to upload this file as an attachment
        $this->actingAs($user)
            ->post(route('attachments.store', $commission), [
                'file' => $file
            ])
            // Assert the file failed to upload.
            ->assertSessionHasErrors();

        $file = UploadedFile::fake()->create('test.mp4', '1024', 'video/mp4');
        // Attempt to upload this file as an attachment
        $this->actingAs($user)
            ->post(route('attachments.store', $commission), [
                'file' => $file
            ])
            // Assert the file failed to upload.
            ->assertSessionHasErrors();

        $file = UploadedFile::fake()->create('test.cpp', '12', 'text/plain');
        // Attempt to upload this file as an attachment
        $this->actingAs($user)
            ->post(route('attachments.store', $commission), [
                'file' => $file
            ])
            // Assert the file failed to upload.
            ->assertSessionHasErrors();
    }

    /** @test */
    public function an_attachment_can_be_added_and_removed_from_commissions()
    {
        // Create a User and Commission
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['creator_id' => $user->id, 'status' => 'Active']);
        $commission = $commission->fresh();

        // Create a dummy image
        $file = UploadedFile::fake()->image('test.png', '64', '64');
        // Attempt to upload this image as an attachment
        $this->actingAs($user)
            ->post(route('attachments.store', $commission), [
                'file' => $file
            ])
            // Assert the file was uploaded successfully
            ->assertSessionHas('success', 'Attachment created')
            // Assert we are redirected back to the commissions page
            ->assertRedirect(route('commissions.show', $commission));
        // Assert we have exactly one commission attachment
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

    /** @test */
    public function an_attachment_cannot_be_deleted_after_completion()
    {
        $user = User::factory()->create();
        $commission = Commission::factory()->create([
            'creator_id' => $user->id,
            'status' => 'Archived'
        ])->fresh();
        $attachment = Attachment::factory()->create([
            'user_id' => $user->id,
            'commission_id' => $commission->id
        ])->fresh();

        $this->actingAs($user)
            ->delete(route('attachments.destroy', $attachment))
            ->assertStatus(401);
    }

    /** @test */
    public function an_attachment_cannot_be_deleted_by_a_third_party()
    {
        $buyer = User::factory()->create();
        $seller = User::factory()->create();
        $commission = Commission::factory()->create([
            'creator_id' => $seller->id,
            'buyer_id' => $buyer->id,
            'status' => 'Active'
        ])->fresh();
        $attachment = Attachment::factory()->create([
            'user_id' => $seller->id,
            'commission_id' => $commission->id
        ])->fresh();

        $this->actingAs($buyer)
            ->delete(route('attachments.destroy', $attachment))
            ->assertStatus(401);
    }

    /** @test */
    public function an_attachment_can_be_deleted_by_its_creator()
    {
        $user = User::factory()->create();
        $commission = Commission::factory()->create([
            'creator_id' => $user->id,
            'status' => 'Active'
        ])->fresh();
        $attachment = Attachment::factory()->create([
            'user_id' => $user->id,
            'commission_id' => $commission->id
        ])->fresh();

        $this->actingAs($user)
            ->delete(route('attachments.destroy', $attachment))
            ->assertSessionHas('success', 'Attachment deleted')
            ->assertRedirect(route('commissions.show', $commission));
    }
}
