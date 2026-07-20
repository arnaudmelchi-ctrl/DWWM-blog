<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('categories')->insert([
    [
        'name'       => 'Développement Web',
        'slug'       => 'developpement-web',
        'created_at' => now(),
    ],
    [
        'name'       => 'Intelligence Artificielle',
        'slug'       => 'intelligence-artificielle',
        'created_at' => now(),
    ],
    [
        'name'       => 'Bases de données',
        'slug'       => 'bases-de-donnees',
        'created_at' => now(),
    ],
    [
        'name'       => 'Tutoriels',
        'slug'       => 'tutoriels',
        'created_at' => now(),
    ],
    [
        'name'       => 'Actualités Tech',
        'slug'       => 'actualites-tech',
        'created_at' => now(),
    ],
     ]);

    }
}
