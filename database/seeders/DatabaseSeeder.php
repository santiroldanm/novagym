<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Routine;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a premium default Administrator user
        $admin = User::create([
            'name' => 'Admin Nova',
            'email' => 'admin@novagym.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Create instructor profile for admin user
        $this->call(InstructorSeeder::class);

        // 3. Generate 18 clients distributed over the last 8 months
        // Let's create an array of specific dates over the last few months to get a beautiful chart curve.
        // Months: Oct, Nov, Dec, Jan, Feb, Mar, Apr, May (assuming current month is May 2026)
        $faker = \Faker\Factory::create();

        $clientProfiles = [
            ['name' => 'Lucas Rivera', 'email' => 'lucas.rivera@example.com', 'phone' => '+34 612 345 678', 'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=200', 'month_offset' => 7],
            ['name' => 'Sofía Medina', 'email' => 'sofia.medina@example.com', 'phone' => '+34 623 456 789', 'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=200', 'month_offset' => 7],
            ['name' => 'Mateo Silva', 'email' => 'mateo.silva@example.com', 'phone' => '+34 634 567 890', 'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=200', 'month_offset' => 6],
            ['name' => 'Valentina Rojas', 'email' => 'valentina.rojas@example.com', 'phone' => '+34 645 678 901', 'photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=200', 'month_offset' => 6],
            ['name' => 'Alejandro Torres', 'email' => 'alejandro.torres@example.com', 'phone' => '+34 656 789 012', 'photo' => null, 'month_offset' => 5],
            ['name' => 'Camila Castro', 'email' => 'camila.castro@example.com', 'phone' => '+34 667 890 123', 'photo' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=200', 'month_offset' => 5],
            ['name' => 'Santiago Delgado', 'email' => 'santiago.delgado@example.com', 'phone' => '+34 678 901 234', 'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200', 'month_offset' => 5],
            ['name' => 'Isabella Ortega', 'email' => 'isabella.ortega@example.com', 'phone' => '+34 689 012 345', 'photo' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=200', 'month_offset' => 4],
            ['name' => 'Daniel Mendoza', 'email' => 'daniel.mendoza@example.com', 'phone' => '+34 690 123 456', 'photo' => null, 'month_offset' => 4],
            ['name' => 'Mariana Guerrero', 'email' => 'mariana.guerrero@example.com', 'phone' => '+34 601 234 567', 'photo' => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&q=80&w=200', 'month_offset' => 3],
            ['name' => 'Sebastián Valenzuela', 'email' => 'sebastian.val@example.com', 'phone' => '+34 611 223 344', 'photo' => null, 'month_offset' => 3],
            ['name' => 'Lucía Beltrán', 'email' => 'lucia.beltran@example.com', 'phone' => '+34 622 334 455', 'photo' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&q=80&w=200', 'month_offset' => 2],
            ['name' => 'Andrés Peña', 'email' => 'andres.pena@example.com', 'phone' => '+34 633 445 566', 'photo' => null, 'month_offset' => 2],
            ['name' => 'Gabriela Fuentes', 'email' => 'gabriela.fuentes@example.com', 'phone' => '+34 644 556 677', 'photo' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&q=80&w=200', 'month_offset' => 2],
            ['name' => 'Joaquín Herrera', 'email' => 'joaquin.herrera@example.com', 'phone' => '+34 655 667 788', 'photo' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&q=80&w=200', 'month_offset' => 1],
            ['name' => 'Paula Vargas', 'email' => 'paula.vargas@example.com', 'phone' => '+34 666 778 899', 'photo' => null, 'month_offset' => 1],
            ['name' => 'Benjamín Navarro', 'email' => 'benjamin.nav@example.com', 'phone' => '+34 677 889 900', 'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=200', 'month_offset' => 0],
            ['name' => 'Emilia Santillán', 'email' => 'emilia.s@example.com', 'phone' => '+34 688 990 011', 'photo' => 'https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?auto=format&fit=crop&q=80&w=200', 'month_offset' => 0],
        ];

        $clients = [];
        foreach ($clientProfiles as $profile) {
            $createdAt = Carbon::now()->subMonths($profile['month_offset'])->subDays(rand(1, 28))->subHours(rand(1, 23));
            $clients[] = Client::create([
                'user_id' => $admin->id,
                'name' => $profile['name'],
                'email' => $profile['email'],
                'phone' => $profile['phone'],
                'photo' => $profile['photo'],
                'status' => $faker->randomElement(['active', 'active', 'active', 'inactive']), // mostly active
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }

        // 4. Generate 10 routines distributed among our clients
        $routineTemplates = [
            [
                'name' => 'Hipertrofia Funcional X',
                'description' => 'Enfoque en fuerza máxima y volumen muscular empleando patrones de movimiento compuestos y alta densidad de entrenamiento. Ideal para atletas avanzados.',
                'difficulty' => 'advanced'
            ],
            [
                'name' => 'Fuerza Básica 5x5',
                'description' => 'Rutina clásica de fuerza basada en ejercicios multiarticulares: Sentadilla, Press Banca, Peso Muerto, Press Militar y Remo con Barra.',
                'difficulty' => 'beginner'
            ],
            [
                'name' => 'Acondicionamiento Nova H.I.I.T',
                'description' => 'Circuito metabólico de alta intensidad para optimizar el consumo de oxígeno (VO2 máx) y acelerar la oxidación de lípidos.',
                'difficulty' => 'intermediate'
            ],
            [
                'name' => 'Powerbuilding Pro',
                'description' => 'Combinación perfecta de levantamientos de fuerza para powerlifting y ejercicios de aislamiento de culturismo para estética.',
                'difficulty' => 'advanced'
            ],
            [
                'name' => 'Movilidad y Core Start',
                'description' => 'Enfoque en mejorar los rangos de movimiento articular, flexibilidad dinámica y estabilización de la zona media.',
                'difficulty' => 'beginner'
            ],
            [
                'name' => 'Full Body Nova Athlete',
                'description' => 'Rutina cuerpo completo de tres días por semana, optimizada para deportistas que buscan rendimiento y desarrollo atlético equilibrado.',
                'difficulty' => 'intermediate'
            ],
            [
                'name' => 'Empuje / Tirón / Pierna (PPL)',
                'description' => 'División clásica para hipertrofia, distribuyendo los días en patrones de empuje, tirón y tren inferior para máxima recuperación.',
                'difficulty' => 'intermediate'
            ],
            [
                'name' => 'Acondicionamiento Cardiovascular GPP',
                'description' => 'Preparación física general enfocada en resistencia cardiovascular mediante remo, bicicleta estática y kettlebell swings.',
                'difficulty' => 'beginner'
            ],
            [
                'name' => 'Fuerza Explosiva y Pliometría',
                'description' => 'Rutina avanzada para el desarrollo de potencia vertical, aceleración y transferencia de fuerza mediante saltos y lanzamientos.',
                'difficulty' => 'advanced'
            ],
            [
                'name' => 'Rutina Definición Estética',
                'description' => 'Volumen de trabajo medio-alto con descansos cortos e inclusión de superseries para optimizar la definición muscular manteniendo la fuerza.',
                'difficulty' => 'intermediate'
            ],
        ];

        // Shuffle clients to assign routines randomly
        shuffle($clients);

        for ($i = 0; $i < count($routineTemplates); $i++) {
            $template = $routineTemplates[$i];
            $client = $clients[$i % count($clients)]; // round-robin assignment

            $createdAt = $client->created_at->addDays(rand(1, 5));

            Routine::create([
                'client_id' => $client->id,
                'name' => $template['name'],
                'description' => $template['description'],
                'difficulty' => $template['difficulty'],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}