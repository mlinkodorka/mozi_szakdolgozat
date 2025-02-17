<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Nyelv;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Film::class;


    public function definition(): array
    { 

        return [
        	'film_cime' => fake('hu_HU')->sentence(),
            'film_evszam' => fake()->year(),
            'szinkronos-e' => fake()->boolean(),
            'hagyományos-e' => fake()->boolean(),
            'film_nyelve' => Nyelv::all()->random()->nyelvkod,
            'film_hossza' => fake()->numberBetween(1, 180)
        ];
    }
}
