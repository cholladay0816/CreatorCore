<?php

namespace Database\Factories;

use App\Models\CommissionPreset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionPresetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionPreset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(2),
            'price' => $this->faker->randomFloat(2, 5,20),
            'days_to_complete' => 7,
        ];
    }
}
