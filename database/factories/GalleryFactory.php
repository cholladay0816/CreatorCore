<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'content' => 'https://tailwindcss.com/img/card-top.jpg',
            'title' => $this->faker->sentence('6'),
            'description'=>$this->faker->sentence(14),
            'size'=>0,
        ];
    }
}
