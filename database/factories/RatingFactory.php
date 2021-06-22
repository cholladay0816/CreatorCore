<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => ($user = User::factory()->create())->id,
            'review_id' => ($review = Review::factory()->create())->id,
            'positive' => '1'
        ];
    }
}
