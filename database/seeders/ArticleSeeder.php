<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $firstCategoryId = DB::table('categories')->value('id');
        $firstUserId = DB::table('users')->oldest('id')->value('id');

        DB::table('articles')->insert([
            [
                'title'      => 'Les bases de la programmation orientée objet',
                'slug'       => 'bases-programmation-orientee-objet',
                'content'    => 'La programmation orientée objet (POO) est un paradigme de programmation basé sur le concept d\'objets...',
                'created_at' =>  Carbon::parse('2026-05-12 10:30:00'),
                'category_id' => $firstCategoryId,
                'user_id' => $firstUserId,
            ],
            [
                'title'      => 'Comprendre les closures en PHP',
                'slug'       => 'comprendre-closures-php',
                'content'    => 'Les closures sont des fonctions anonymes qui peuvent capturer des variables de leur portée parente...',
                'created_at' =>  Carbon::parse('2026-06-15 14:45:00'),
                'category_id' => $firstCategoryId,
                'user_id' => $firstUserId,
            ],
            [
                'title'      => 'Guide ultime du développement web moderne',
                'slug'       => 'guide-ultime-developpement-web-moderne',
                'content'    => 'Le développement web a énormément évolué ces dernières années avec l\'avènement des frameworks JS...',
                'created_at' =>  Carbon::parse('2026-07-01 09:00:00'),
                'category_id' => $firstCategoryId,
                'user_id' => $firstUserId,
            ],
            [
                'title'      => 'Optimiser ses requêtes SQL',
                'slug'       => 'optimiser-requetes-sql',
                'content'    => 'L\'optimisation des bases de données est cruciale pour la performance de toute application...',
                'created_at' =>  Carbon::parse('2026-07-15 16:30:00'),
                'category_id' => $firstCategoryId,
                'user_id' => $firstUserId,
            ],
        ]);
    }
}