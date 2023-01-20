<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(25),
            'content' => $this->faker->text(1000),
            'author_id' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomDigit,
            'cover' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
            'year_published' => $this->faker->year

        ];
    }
}
