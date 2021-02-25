<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\CommissionEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'commission_id', ($commission = Commission::factory()->create())->id,
            'title' => $this->faker->sentence,
            'color' => 'blue-500',
            'status' => 'Unpaid'
        ];
    }
}
