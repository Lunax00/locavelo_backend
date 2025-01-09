<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeVelo;

class TypeVeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeVelo::create([
            'name' => 'Vélo de Ville',
            'description' => 'Un vélo léger idéal pour les déplacements urbains.',
            'image' => 'velo_de_ville.jpg',
            'price' => 10.00, // Prix par heure
        ]);

        TypeVelo::create([
            'name' => 'VTT (Vélo Tout Terrain)',
            'description' => 'Parfait pour les chemins accidentés et les aventures en plein air.',
            'image' => 'vtt.jpg',
            'price' => 15.00,
        ]);

        TypeVelo::create([
            'name' => 'Vélo Électrique',
            'description' => 'Un vélo avec assistance électrique pour un effort réduit.',
            'image' => 'velo_electrique.jpg',
            'price' => 20.00,
        ]);

        TypeVelo::create([
            'name' => 'Vélo Enfant',
            'description' => 'Adapté pour les enfants, idéal pour l’apprentissage.',
            'image' => 'velo_enfant.jpg',
            'price' => 5.00,
        ]);
    }
}
