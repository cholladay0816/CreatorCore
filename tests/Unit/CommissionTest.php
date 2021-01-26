<?php

namespace Tests\Unit;

use App\Models\Commission;
use App\Models\CommissionPreset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_commission_has_a_buyer()
    {
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['buyer_id' => $user->id]);

        $this->assertEquals($commission->buyer->id, $user->id);
    }

    /** @test */
    public function a_commission_has_a_creator()
    {
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['creator_id' => $user->id]);

        $this->assertEquals($commission->creator->id, $user->id);
    }

    /** @test */
    public function a_commission_has_a_preset()
    {
        $preset = CommissionPreset::factory()->create();
        $commission = Commission::factory()->create(['commission_preset_id' => $preset->id]);

        $this->assertEquals($commission->preset->id, $preset->id);
    }

    /** @test */
    public function a_commission_can_have_a_null_preset()
    {
        $commission = Commission::factory()->create(['commission_preset_id' => null]);

        $this->assertEquals($commission->preset, null);
    }

    /** @test */
    public function a_commission_with_a_preset_does_not_need_duplicate_fields_assigned()
    {
        // Generates and assigns the preset to this commission, intentionally excluding vital data
        $preset = CommissionPreset::factory()->create();
        $commission = new Commission(
            [
                'buyer_id' => User::factory()->create()->id,
                'creator_id' => User::factory()->create()->id,
                'commission_preset_id' => $preset->id
            ]
        );
        // Stores the commission in the database
        $commission->save();

        // Asserts that each field was entered automatically by the preset.
        $this->assertEquals($commission->title, $preset->title);
        $this->assertEquals($commission->description, $preset->description);
        $this->assertEquals($commission->price, $preset->price);
        $this->assertEquals($commission->days_to_complete, $preset->days_to_complete);
    }
}
