<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Mohamed Ben Ali',
                'email' => 'mohamed.benali@example.com',
                'password' => Hash::make('password123'),
                'credits' => 150,
                'status' => 'Actif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fatima Zahra',
                'email' => 'fatima.zahra@example.com',
                'password' => Hash::make('password123'),
                'credits' => 200,
                'status' => 'Sanctionné',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khalid Abdelrahman',
                'email' => 'khalid.abdelrahman@example.com',
                'password' => Hash::make('password123'),
                'credits' => 100,
                'status' => 'Actif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aicha Mansouri',
                'email' => 'aicha.mansouri@example.com',
                'password' => Hash::make('password123'),
                'credits' => 80,
                'status' => 'Actif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
