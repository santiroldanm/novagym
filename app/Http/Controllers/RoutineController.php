<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Client;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RoutineController extends Controller
{
    


    public function index()
    {
        
        $routines = Routine::with(['client', 'instructor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('routines.index', compact('routines'));
    }

    


    public function create()
    {
        
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        return view('routines.create', compact('clients'));
    }

    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
        ]);

        
        $instructorId = null;
        if (Auth::check()) {
            $instructor = Auth::user()->instructor; 
            if ($instructor) {
                $instructorId = $instructor->id;
            }
        }

        $validated['instructor_id'] = $instructorId;

        Routine::create($validated);

        return redirect()->route('routines.index')
            ->with('success', 'Rutina de entrenamiento creada y asignada exitosamente.');
    }

    


    public function edit(Routine $routine)
    {
        $clients = Client::orderBy('name')->get();
        return view('routines.edit', compact('routine', 'clients'));
    }

    


    public function update(Request $request, Routine $routine)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
        ]);

        
        if (Auth::check()) {
            $instructor = Auth::user()->instructor;
            if ($instructor) {
                $validated['instructor_id'] = $instructor->id;
            }
            
        }

        $routine->update($validated);

        return redirect()->route('routines.index')
            ->with('success', 'Rutina de entrenamiento actualizada correctamente.');
    }

    


    public function destroy(Routine $routine)
    {
        $routine->delete();

        return redirect()->route('routines.index')
            ->with('success', 'Rutina eliminada exitosamente.');
    }

    


    public function downloadPdf($id)
    {
        $routine = Routine::with(['client', 'instructor'])->findOrFail($id);
        
        $pdf = Pdf::loadView('routines.pdf', compact('routine'));
        
        return $pdf->download('rutina_' . \Illuminate\Support\Str::slug($routine->name) . '.pdf');
    }
}