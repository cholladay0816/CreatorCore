<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => ($user = User::factory()->create())->id,
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(5)
        ];
    }
}
