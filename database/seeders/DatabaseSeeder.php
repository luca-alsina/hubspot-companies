<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Création d'un utilisateur de test
        \App\Models\User::factory()->create([
            'name' => 'Kaffein Test User',
            'email' => 'test@kaffein.dev',
        ]);
    }
}
