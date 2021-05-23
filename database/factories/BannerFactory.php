<?php

namespace Database\Factories;

use App\Models\banner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => (User::factory()->create())->id,
            'size' => $this->faker->numberBetween(1, 1024),
            'path' => 'banner/' . $this->faker->imageUrl(),
            'type' => 'image/png',
        ];
    }
}
