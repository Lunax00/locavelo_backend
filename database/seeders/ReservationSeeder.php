<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Bike;
use App\Models\Station;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        $users = User::pluck('id'); // Récupérer les IDs des utilisateurs
        $bikes = Bike::pluck('id'); // Récupérer les IDs des vélos
        $stations = Station::pluck('id'); // Récupérer les IDs des stations

        if ($users->isEmpty() || $bikes->isEmpty() || $stations->isEmpty()) {
            $this->command->error('Les utilisateurs, vélos, ou stations sont absents. Assurez-vous que les seeders correspondants sont exécutés.');
            return;
        }

        // Créer des réservations fictives
        for ($i = 0; $i < 20; $i++) {
            $startStation = $stations->random();
            $endStation = $stations->random();
            
            Reservation::create([
                'user_id' => $users->random(),
                'bike_id' => $bikes->random(),
                'start_station_id' => $startStation,
                'end_station_id' => $endStation == $startStation ? null : $endStation, // Éviter la même station
                'reservation_time' => Carbon::now()->subDays(rand(1, 30)), // Date entre 1 et 30 jours en arrière
                'return_time' => rand(0, 1) ? Carbon::now() : null, // Parfois null pour des vélos non retournés
            ]);
        }
    }
}
