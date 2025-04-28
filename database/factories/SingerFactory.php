<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SingerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'genre' => fake()->randomElement(['Pop', 'Rock', 'Hip Hop', 'Sertanejo', 'MPB', 'Eletrônica', 'Funk', 'Country']),
            'birth_date' => fake()->dateTimeBetween('-75 years', '-18 years'),
            'bio' => fake()->paragraph(1),
            'label' => fake()->company(),
        ];
    }
}