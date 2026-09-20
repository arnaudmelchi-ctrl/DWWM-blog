<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Création de l'utilisateur admin/test
        User::factory()->create([
            'first_name' => 'Test',
            'last_name'  => 'User',
            'email'      => 'test@example.com',
            'role'       => 'admin',
            'password'   => Hash::make('password123'),
        ]);

        // 2. Appel de tous les seeders dans l'ordre logique
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,      // Ajouté pour peupler les tags
            ArticleSeeder::class,
        ]);
    }
}