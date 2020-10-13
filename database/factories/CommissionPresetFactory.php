<?php

namespace Database\Factories;

use App\Models\CommissionPreset;
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
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(7),
            'description'=>$this->faker->sentence(14),
            'price'=> 5,
            'min_days_to_complete' => 3,
            'days_to_complete' => 7,
        ];
    }
}
