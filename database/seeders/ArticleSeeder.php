<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {

        DB::table('articles')->insert([
            [
                'title'      => 'Les bases de la programmation orientée objet',
                'slug'       => 'bases-programmation-orientee-objet',
                'content'    => 'La programmation orientée objet (POO) est un paradigme de programmation basé sur le concept d\'objets...',
                'created_at' => now(),
            ],
            [
                'title'      => 'Comprendre les closures en PHP',
                'slug'       => 'comprendre-closures-php',
                'content'    => 'Les closures sont des fonctions anonymes qui peuvent capturer des variables de leur portée parente...',
                'created_at' => now()->subDays(2),
            ],
            [
                'title'      => 'Guide ultime du développement web moderne',
                'slug'       => 'guide-ultime-developpement-web-moderne',
                'content'    => 'Le développement web a énormément évolué ces dernières années avec l\'avènement des frameworks JS...',
                'created_at' => now()->subWeek(),
            ],
            [
                'title'      => 'Optimiser ses requêtes SQL',
                'slug'       => 'optimiser-requetes-sql',
                'content'    => 'L\'optimisation des bases de données est cruciale pour la performance de toute application...',
                'created_at' => now()->subMonth(),
            ],
        ]);
    }
}