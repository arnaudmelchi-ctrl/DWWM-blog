<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'PHP', 'slug' => 'php', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laravel', 'slug' => 'laravel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SQL', 'slug' => 'sql', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}