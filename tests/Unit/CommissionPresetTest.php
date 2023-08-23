<?php

namespace Tests\Unit;

use App\Models\CommissionPreset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommissionPresetTest extends TestCase
{
    use RefreshDatabase;

    public function login()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }

    /** @test */
    public function a_commission_preset_has_an_owner()
    {
        $user = User::factory()->create();
        $preset = CommissionPreset::factory()->create(['user_id' => $user->id]);
        $this->assertEquals($preset->user->id, $user->id);
    }

    /** @test */
    public function a_commission_preset_has_a_title()
    {
        $preset = CommissionPreset::factory()->create(['title' => 'Test Title']);
        $this->assertEquals('Test Title', $preset->title);
    }

    /** @test */
    public function a_commission_preset_has_a_description()
    {
        $preset = CommissionPreset::factory()->create(['description' => 'Test Desc']);
        $this->assertEquals('Test Desc', $preset->description);
    }

    /** @test */
    public function a_commission_preset_has_a_price()
    {
        $preset = CommissionPreset::factory()->create(['price' => '5.01']);
        $this->assertEquals('5.01', $preset->price);
    }

    /** @test */
    public function a_commission_preset_has_days_to_complete()
    {
        $preset = CommissionPreset::factory()->create(['days_to_complete' => '3']);
        $this->assertEquals('3', $preset->days_to_complete);
    }
}
