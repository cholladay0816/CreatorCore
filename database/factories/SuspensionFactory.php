<?php

namespace Database\Factories;

use App\Models\Suspension;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuspensionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suspension::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => ($user = User::factory()->create())->id,
            'reason' => 'No reason provided.',
            'days' => 7
        ];
    }
}
