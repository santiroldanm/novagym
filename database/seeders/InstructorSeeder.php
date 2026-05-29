<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instructor;
use Illuminate\Support\Facades\Hash;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an instructor for the existing admin user (if not exists)
        $adminUser = User::where('email', 'admin@novagym.com')->first();

        if ($adminUser && !$adminUser->instructor) {
            Instructor::create([
                'user_id' => $adminUser->id,
                'name' => $adminUser->name,
                'email' => $adminUser->email,
                'phone' => '+1234567890',
                'specialty' => 'Personalizada',
                'photo' => null,
                'status' => 'active',
            ]);

            $this->command->info('Instructor record created for admin user.');
        } elseif (!$adminUser) {
            $this->command->error('Admin user not found.');
        } else {
            $this->command->info('Instructor record already exists for admin user.');
        }
    }
}