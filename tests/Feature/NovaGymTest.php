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

    /**
     * Test public API endpoints return correctly structured JSON.
     */
    public function test_public_api_endpoints(): void
    {
        // 1. Clients API
        $response = $this->getJson('/api/public/clients');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'count',
                'data'
            ]);

        // 2. Routines API
        $response = $this->getJson('/api/public/routines');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'count',
                'data'
            ]);

        // 3. Instructors API
        $response = $this->getJson('/api/public/instructors');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'count',
                'data'
            ]);
    }

    /**
     * Test the forgot password request flow.
     */
    public function test_forgot_password_sends_email(): void
    {
        // Create user
        $user = User::factory()->create([
            'email' => 'test-recover@novagym.com'
        ]);

        $response = $this->post('/forgot-password', [
            'email' => 'test-recover@novagym.com'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    /**
     * Test backend PDF generation route.
     */
    public function test_download_routine_pdf_returns_pdf(): void
    {
        // Create user
        $user = User::factory()->create();
        
        // Create client
        $client = Client::create([
            'user_id' => $user->id,
            'name' => 'Test Client',
            'email' => 'testclient@example.com',
            'status' => 'active'
        ]);

        // Create instructor
        $instructor = Instructor::create([
            'user_id' => $user->id,
            'name' => 'Test Instructor',
            'email' => 'testinstructor@example.com',
            'status' => 'active'
        ]);

        // Create routine
        $routine = Routine::create([
            'client_id' => $client->id,
            'instructor_id' => $instructor->id,
            'name' => 'Rutina de Fuerza Test',
            'description' => 'Descripción detallada de la rutina de prueba.',
            'difficulty' => 'beginner'
        ]);

        // Authenticate and fetch PDF
        $response = $this->actingAs($user)
            ->get("/routines/{$routine->id}/pdf");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
