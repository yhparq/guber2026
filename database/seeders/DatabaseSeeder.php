<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Users
        User::updateOrCreate(
            ['email' => 'Ccpmdd@gmail.com'],
            [
                'name' => 'Fiorella Madre de Dios',
                'password' => bcrypt('73119895'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
            ]
        );
    }
}