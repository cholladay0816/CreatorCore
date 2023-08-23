<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\CommissionPreset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'buyer_id' => User::factory()->create()->id,
            'creator_id' => ($creator = User::factory()->create())->id,
            'commission_preset_id' => null,
            'title' => $preset->title ?? $this->faker->sentence(5),
            'description' => $preset->description ?? $this->faker->paragraph(2),
            'memo' => $this->faker->paragraph(3),
            'price' => $preset->price ?? $this->faker->randomFloat(2, 5, 20),
            'status' => 'Unpaid',
            'days_to_complete' => $preset->days_to_complete ?? '7',
        ];
    }
}
