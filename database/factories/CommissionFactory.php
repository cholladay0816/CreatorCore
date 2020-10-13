<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\CommissionPreset;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'buyer_id' => 1,
            'creator_id' => 1,
            'preset_id' => null,
            'title' => $this->faker->sentence(7),
            'description' => $this->faker->sentence(14),
            'note' => $this->faker->paragraph(3),
            'price' => 5,
        ];
    }
}
