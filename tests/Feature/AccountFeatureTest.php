<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountFeatureTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function a_user_can_generate_an_account_by_visiting_the_profile_page()
    {
        $user = User::factory()->create();
        $this->assertNull($user->stripe_account_id);

        $response = $this->actingAs($user)
            ->get(route('profile.show'));
        $response->assertStatus(200);

        $this->assertNotNull($user->fresh()->stripe_account_id);
    }
}
