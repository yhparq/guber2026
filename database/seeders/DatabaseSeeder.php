<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Participant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Participant::create([
            'dni' => '12345678',
            'nombres' => 'Juan',
            'apellidos' => 'Perez',
            'email' => 'juan@example.com',
            'celular' => '987654321',
            'categoria_participante' => 'Estudiante',
            'modalidad_participante' => 'Presencial',
            'direccion_actual' => 'Av. Siempre Viva 123',
        ]);

        Participant::create([
            'dni' => '87654321',
            'nombres' => 'Maria',
            'apellidos' => 'Lopez',
            'email' => 'maria@example.com',
            'celular' => '912345678',
            'categoria_participante' => 'Profesional',
            'modalidad_participante' => 'Virtual',
            'direccion_actual' => 'Jr. Los Andes 456',
        ]);

        // Corporate participant (using same table fields)
        Participant::create([
            'dni' => '20123456789', // RUC
            'nombres' => 'Tech Solutions',
            'apellidos' => 'SAC',
            'email' => 'contacto@techsolutions.com',
            'celular' => '01234567',
            'categoria_participante' => 'Corporativo',
            'modalidad_participante' => 'Virtual',
            'direccion_actual' => 'Av. Javier Prado 100',
        ]);

        \App\Models\Course::create(['title' => 'Laravel Basics', 'description' => 'Introduction to Laravel']);
        \App\Models\Course::create(['title' => 'Vue.js Mastery', 'description' => 'Master Vue.js with Composition API']);

        \App\Models\Photo::create(['title' => 'Office View', 'path' => 'office.jpg']);
        \App\Models\Photo::create(['title' => 'Team Meeting', 'path' => 'team.jpg']);
    }
}
