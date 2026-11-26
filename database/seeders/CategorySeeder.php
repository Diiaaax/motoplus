<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Motos Électriques', 'slug' => 'motos-electriques'],
            ['name' => 'Scooters Électriques', 'slug' => 'scooters-electriques'],
            ['name' => 'Vélos Électriques', 'slug' => 'velos-electriques'],
            ['name' => 'Batteries', 'slug' => 'batteries'],
            ['name' => 'Chargeurs', 'slug' => 'chargeurs'],
            ['name' => 'Pièces Détachées', 'slug' => 'pieces-detachees'],
            ['name' => 'Accessoires', 'slug' => 'accessoires'],
            ['name' => 'Équipement du Pilote', 'slug' => 'equipement-pilote'],
            ['name' => 'Entretien', 'slug' => 'entretien'],
            ['name' => 'Promotions', 'slug' => 'promotions'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
