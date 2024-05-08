<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creazione dell'utente amministratore
        User::create([
            'name' => 'AdminSuperUser',
            'email' => 'adminsuper@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Creazione dell'utente normale
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);
    }
}
