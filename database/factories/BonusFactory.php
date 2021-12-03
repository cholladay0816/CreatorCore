<?php

namespace Database\Factories;

use App\Models\Commission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BonusFactory extends Factory
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
            'commission_id' => ($commission = Commission::factory()->create(['creator_id' => $user->id]))->id,
            'amount' => $commission->price * 100,
        ];
    }
}
