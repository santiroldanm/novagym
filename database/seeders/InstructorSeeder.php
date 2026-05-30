<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instructor;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create/link instructor profile for the admin user
        $adminUser = User::where('email', 'albertogutierrezbedoya@gmail.com')->first();

        if ($adminUser && !$adminUser->instructor) {
            Instructor::create([
                'user_id' => $adminUser->id,
                'name' => 'Admin Nova (Coach)',
                'email' => $adminUser->email,
                'phone' => '+34 600 111 222',
                'specialty' => 'Entrenamiento Funcional & GPP',
                'photo' => 'https://images.unsplash.com/photo-1568602471122-7832951cc4c5?auto=format&fit=crop&q=80&w=200',
                'status' => 'active',
            ]);
            $this->command->info('Instructor record created for admin user.');
        }

        // 2. Seed other premium instructors (nullable user_id)
        $instructorsData = [
            [
                'name' => 'Carlos Mendoza',
                'email' => 'carlos.mendoza@novagym.com',
                'phone' => '+34 611 222 333',
                'specialty' => 'Powerlifting & Fuerza Máxima',
                'photo' => 'https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?auto=format&fit=crop&q=80&w=200',
                'status' => 'active',
            ],
            [
                'name' => 'Elena Rostova',
                'email' => 'elena.rostova@novagym.com',
                'phone' => '+34 622 333 444',
                'specialty' => 'Nutrición Deportiva & Recomposición',
                'photo' => 'https://images.unsplash.com/photo-1594381898411-846e7d193883?auto=format&fit=crop&q=80&w=200',
                'status' => 'active',
            ],
            [
                'name' => 'Marcus Vance',
                'email' => 'marcus.vance@novagym.com',
                'phone' => '+34 633 444 555',
                'specialty' => 'CrossFit Coach & HIIT',
                'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200',
                'status' => 'active',
            ],
            [
                'name' => 'Silvia Guerrero',
                'email' => 'silvia.guerrero@novagym.com',
                'phone' => '+34 644 555 666',
                'specialty' => 'Yoga, Flexibilidad & Movilidad',
                'photo' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=200',
                'status' => 'active',
            ],
            [
                'name' => 'Daniela Ortiz',
                'email' => 'daniela.ortiz@novagym.com',
                'phone' => '+34 655 666 777',
                'specialty' => 'Pilates & Recuperación Lesiones',
                'photo' => 'https://images.unsplash.com/photo-1548690312-e3b507d8c110?auto=format&fit=crop&q=80&w=200',
                'status' => 'inactive', // inactive for variety
            ],
        ];

        foreach ($instructorsData as $data) {
            Instructor::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }

        $this->command->info('Premium instructors seeded successfully.');
    }
}