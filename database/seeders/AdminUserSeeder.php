<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create superadmin
        User::updateOrCreate(
            ['email' => 'superadmin@teszt.hu'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('jelszo123'),
                'role' => 'superadmin',
            ]
        );

        // Create normal admin
        User::updateOrCreate(
            ['email' => 'admin@teszt.hu'],
            [
                'name' => 'Normal Admin',
                'password' => Hash::make('jelszo123'),
                'role' => 'admin',
            ]
        );
    }
}
