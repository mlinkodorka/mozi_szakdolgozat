<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
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
            'felhasznalonev' => $faker->unique()->userName(),
            'jelszo_hash' => Hash::make('password'),
            'teljes_nev' => $faker->name(),
            'szuletesi_datum' => $faker->date(),
            'email' => $faker->unique()->safeEmail(),
            'telefonszam' => $faker->phoneNumber(),
        ];
    }
}
