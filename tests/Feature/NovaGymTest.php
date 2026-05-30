<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Client;
use App\Models\Routine;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NovaGymTest extends TestCase
{
    use DatabaseTransactions;

    


    public function test_public_api_endpoints(): void
    {
        
        $response = $this->getJson('/api/public/clients');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'count',
                'data'
            ]);

        
        $response = $this->getJson('/api/public/routines');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'count',
                'data'
            ]);

        
        $response = $this->getJson('/api/public/instructors');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'count',
                'data'
            ]);
    }

    


    public function test_forgot_password_sends_email(): void
    {
        
        $user = User::factory()->create([
            'email' => 'test-recover@novagym.com'
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'test-recover@novagym.com'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    


    public function test_download_routine_pdf_returns_pdf(): void
    {
        
        $user = User::factory()->create();
        
        
        $client = Client::create([
            'user_id' => $user->id,
            'name' => 'Test Client',
            'email' => 'testclient@example.com',
            'status' => 'active'
        ]);

        
        $instructor = Instructor::create([
            'user_id' => $user->id,
            'name' => 'Test Instructor',
            'email' => 'testinstructor@example.com',
            'status' => 'active'
        ]);

        
        $routine = Routine::create([
            'client_id' => $client->id,
            'instructor_id' => $instructor->id,
            'name' => 'Rutina de Fuerza Test',
            'description' => 'Descripción detallada de la rutina de prueba.',
            'difficulty' => 'beginner'
        ]);

        
        $response = $this->actingAs($user)
            ->get("/routines/{$routine->id}/pdf");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
