<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Client;
use App\Models\Branch;
use App\Models\Membership;
use App\Models\MealPlan;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Carbon\Carbon;

class NovaGymExtensionTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Branch creation and client assignment.
     */
    public function test_branch_creation_and_client_assignment(): void
    {
        $user = User::factory()->create();

        // 1. Create a branch
        $branch = Branch::create([
            'name' => 'Sede Norte Test',
            'address' => 'Av. de las Pruebas 123',
            'phone' => '+34 699 999 999',
            'schedule' => 'Lunes a Viernes 6am - 10pm',
            'status' => 'active'
        ]);

        $this->assertDatabaseHas('branches', [
            'name' => 'Sede Norte Test',
            'status' => 'active'
        ]);

        // 2. Create client and assign to branch
        $client = Client::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'name' => 'Atleta de Pruebas',
            'email' => 'atleta_branch_test@example.com',
            'status' => 'active'
        ]);

        $this->assertDatabaseHas('clients', [
            'name' => 'Atleta de Pruebas',
            'branch_id' => $branch->id
        ]);

        $this->assertEquals($branch->id, $client->branch->id);
        $this->assertEquals('Sede Norte Test', $client->branch->name);
        $this->assertCount(1, $branch->clients);
    }

    /**
     * Test Membership creation and dates calculations.
     */
    public function test_membership_creation_and_date_calculations(): void
    {
        $user = User::factory()->create();

        $client = Client::create([
            'user_id' => $user->id,
            'name' => 'Socio Membresia Test',
            'email' => 'sociomembresiatest@example.com',
            'status' => 'active'
        ]);

        $instructor = Instructor::create([
            'user_id' => $user->id,
            'name' => 'Coach Membresia Test',
            'email' => 'coachmembresiatest@example.com',
            'status' => 'active'
        ]);

        // Authenticate user
        $this->actingAs($user);

        // Store via controller logic / POST request
        $startDate = Carbon::now()->toDateString();
        $expectedEndDate = Carbon::parse($startDate)->addMonth()->toDateString(); // monthly is +1 month

        $response = $this->post(route('memberships.store'), [
            'client_id' => $client->id,
            'plan_name' => 'Plan Mensual Test',
            'plan_type' => 'monthly',
            'price' => 45.99,
            'start_date' => $startDate,
            'status' => 'active',
            'notes' => 'Notas de prueba para membresía'
        ]);

        $response->assertRedirect(route('memberships.index'));

        $this->assertDatabaseHas('memberships', [
            'client_id' => $client->id,
            'plan_name' => 'Plan Mensual Test',
            'plan_type' => 'monthly',
            'price' => 45.99,
            'start_date' => $startDate,
            'end_date' => $expectedEndDate,
            'status' => 'active'
        ]);
    }

    /**
     * Test MealPlan creation and PDF generation download.
     */
    public function test_meal_plan_pdf_download(): void
    {
        $user = User::factory()->create();

        $client = Client::create([
            'user_id' => $user->id,
            'name' => 'Socio Dieta Test',
            'email' => 'sociodietatest@example.com',
            'status' => 'active'
        ]);

        $instructor = Instructor::create([
            'user_id' => $user->id,
            'name' => 'Nutri Coach Test',
            'email' => 'nutricoachtest@example.com',
            'status' => 'active'
        ]);

        // Create meal plan
        $mealPlan = MealPlan::create([
            'client_id' => $client->id,
            'instructor_id' => $instructor->id,
            'name' => 'Plan Hipertrofia Test',
            'description' => 'Desayuno: Claras de huevo. Almuerzo: Pollo y arroz.',
            'calories' => 2800,
            'proteins_g' => 180,
            'carbs_g' => 350,
            'fats_g' => 70
        ]);

        $this->assertDatabaseHas('meal_plans', [
            'name' => 'Plan Hipertrofia Test',
            'calories' => 2800
        ]);

        // Authenticate and fetch PDF
        $response = $this->actingAs($user)
            ->get(route('meal-plans.pdf', $mealPlan->id));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
