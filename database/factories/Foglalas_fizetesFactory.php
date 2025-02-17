<?php

namespace Database\Factories;

use App\Models\Vetites;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Foglalas_fizetes>
 */
class Foglalas_fizetesFactory extends Factory
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
            'vetites' => Vetites::all()->random()->vetites_id,
            'lefoglalt_jegyek_szama' => $faker->numberBetween(1, 10),
            'vasarlo_foglalt_e' => $faker->boolean(),
            'vasarlo_email' => $faker->unique()->safeEmail(),
            'lejar' => $faker->dateTimeBetween('+1 day', '+1 week'),
            'fizetve_van_e' => $faker->boolean(),
            'kifizetes_ideje' => $faker->optional()->dateTimeBetween('now', '+1 week'),
        ];
    }
}
