<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Station;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Station::create([
            'name' => 'Station Centre Casablanca',
            'address' => 'Centre Ville, Casablanca',
            'capacity' => 20,
            'coordinates' => '33.589886,-7.603869',
            'image' => 'station_centre.jpg',
        ]);

        Station::create([
            'name' => 'Station Ain Diab',
            'address' => 'Ain Diab, Casablanca',
            'capacity' => 30,
            'coordinates' => '33.594570,-7.669920',
            'image' => 'station_aindiab.jpg',
        ]);

        Station::create([
            'name' => 'Station Sidi Maarouf',
            'address' => 'Sidi Maarouf, Casablanca',
            'capacity' => 25,
            'coordinates' => '33.537867,-7.646560',
            'image' => 'station_sidi.jpg',
        ]);
    }
}
