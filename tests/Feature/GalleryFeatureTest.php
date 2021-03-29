<?php

namespace Tests\Feature;

use App\Models\Commission;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class GalleryFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_cannot_be_over_4MB()
    {
        $user = User::factory()->create();
        // Create a dummy image
        $file = UploadedFile::fake()->image('test.png')->size(4097);
        // Attempt to upload this file as an attachment
        $this->actingAs($user);
        Livewire::test('creator.gallery', ['user' => $user])
            ->set('file', $file)
            ->assertHasErrors();
    }
    /** @test */
    public function it_cannot_total_20MB()
    {
        $user = User::factory()->create();

        // Gallery with size 21 MB
        Gallery::factory()->create(['user_id' => $user->id, 'size' => (21 * 1024 * 1024)]);

        $this->assertGreaterThan((20 * 1024 * 1024), $user->fresh()->bytesUsed());

        $file = UploadedFile::fake()->image('test.png')->size(512);
        $res = Livewire::test('creator.gallery', ['user' => $user])
            ->set('file', $file)
            ->assertHasErrors();
    }
}
