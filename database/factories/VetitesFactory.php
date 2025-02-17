<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Terem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vetites>
 */
class VetitesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake('hu_HU');
        $film = Film::all()->random();
        return [
            'film_cime' => $film->film_cime,
            'film_evszam' => $film->film_evszam,
            'terem' => Terem::all()->random()->terem_id,
            'kezdes_ideje' => $faker->dateTimeBetween('+1 day', '+1 month'),
            'publikus_e' => $faker->boolean(),
            'jegy_ara' => $faker->numberBetween(990, 5000),
            'szabad_helyek_szama' => $faker->numberBetween(20,100),
            'foglalt_helyek_szama' => $faker->numberBetween(0, 100),
        ];
    }
}
