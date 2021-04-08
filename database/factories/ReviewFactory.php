<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Commission;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => ($user = User::factory()->create())->id,
            'commission_id' => ($commission = Commission::factory()->create(['buyer_id'=>$user->id]))->id,
            'attachment_id' => null,
            'positive' => $this->faker->numberBetween(0, 1),
            'message' => $this->faker->paragraph(3),
            'anonymous' => 0,
        ];
    }
}
