<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bike;
use App\Models\Station;

class BikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les stations existantes
        $stations = Station::all();

        if ($stations->isEmpty()) {
            $this->command->warn('No stations found. Please seed stations first.');
            return;
        }

        // Générer 20 vélos
        for ($i = 1; $i <= 20; $i++) {
            Bike::create([
                'type_velo_id' => rand(1, 4), // Assurez-vous que vous avez 4 types de vélos seeded
                'state' => ['Disponible', 'En réparation', 'Hors service'][rand(0, 2)], // État aléatoire
                'station_id' => $stations->random()->id, // Associer à une station aléatoire
            ]);
        }
    }
}
