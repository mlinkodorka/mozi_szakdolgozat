<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Terem>
 */
class TeremFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('hu_HU');

        return [
            'terem_nev' => $faker->unique()->word(),
            'kapacitas' => $faker->numberBetween(20, 100),
        ];
    }
}
