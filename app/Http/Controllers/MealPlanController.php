<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\Client;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MealPlanController extends Controller
{
    


    public function index()
    {
        $mealPlans = MealPlan::with(['client', 'instructor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('meal_plans.index', compact('mealPlans'));
    }

    


    public function create()
    {
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        return view('meal_plans.create', compact('clients'));
    }

    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'calories' => 'nullable|integer|min:0',
            'proteins_g' => 'nullable|integer|min:0',
            'carbs_g' => 'nullable|integer|min:0',
            'fats_g' => 'nullable|integer|min:0',
        ]);

        $data = $validated;

        
        $instructorId = null;
        if (Auth::check()) {
            $instructor = Auth::user()->instructor;
            if ($instructor) {
                $instructorId = $instructor->id;
            }
        }
        $data['instructor_id'] = $instructorId;

        MealPlan::create($data);

        return redirect()->route('meal-plans.index')
            ->with('success', 'Plan de alimentación creado y asignado exitosamente.');
    }

    


    public function edit(MealPlan $mealPlan)
    {
        $clients = Client::orderBy('name')->get();
        return view('meal_plans.edit', compact('mealPlan', 'clients'));
    }

    


    public function update(Request $request, MealPlan $mealPlan)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'calories' => 'nullable|integer|min:0',
            'proteins_g' => 'nullable|integer|min:0',
            'carbs_g' => 'nullable|integer|min:0',
            'fats_g' => 'nullable|integer|min:0',
        ]);

        $data = $validated;

        if (Auth::check()) {
            $instructor = Auth::user()->instructor;
            if ($instructor) {
                $data['instructor_id'] = $instructor->id;
            }
        }

        $mealPlan->update($data);

        return redirect()->route('meal-plans.index')
            ->with('success', 'Plan de alimentación actualizado correctamente.');
    }

    


    public function destroy(MealPlan $mealPlan)
    {
        $mealPlan->delete();

        return redirect()->route('meal-plans.index')
            ->with('success', 'Plan de alimentación eliminado exitosamente.');
    }

    


    public function downloadPdf($id)
    {
        $mealPlan = MealPlan::with(['client', 'instructor'])->findOrFail($id);

        $pdf = Pdf::loadView('meal_plans.pdf', compact('mealPlan'));

        return $pdf->download('plan_alimentacion_' . \Illuminate\Support\Str::slug($mealPlan->name) . '.pdf');
    }
}
