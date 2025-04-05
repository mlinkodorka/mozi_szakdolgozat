<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Film;
use App\Models\Foglalas_fizetes;
use App\Models\Nyelv;
use App\Models\Terem;
use App\Models\User;
use App\Models\Vetites;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //User::factory()->create([
            //'name' => 'Test User',
            //'email' => 'test@example.com',
        //]);

        Nyelv::factory()->count(100)->create();

        Film::factory()->count(5)->create();

        Terem::factory()->count(2)->create();

        Admin::factory()->count(2)->create();

        Vetites::factory()->count(10)->create();

        Foglalas_fizetes::factory()->count(20)->create();

        $this->call(AdminUserSeeder::class);

    }
}
