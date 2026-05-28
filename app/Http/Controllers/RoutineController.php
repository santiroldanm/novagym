<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Client;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /**
     * Display a listing of the routines.
     */
    public function index()
    {
        // Load routines with their client relation
        $routines = Routine::with('client')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('routines.index', compact('routines'));
    }

    /**
     * Show the form for creating a new routine.
     */
    public function create()
    {
        // Fetch only active clients for new routines
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        return view('routines.create', compact('clients'));
    }

    /**
     * Store a newly created routine in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
        ]);

        Routine::create($validated);

        return redirect()->route('routines.index')
            ->with('success', 'Rutina de entrenamiento creada y asignada exitosamente.');
    }

    /**
     * Show the form for editing the specified routine.
     */
    public function edit(Routine $routine)
    {
        $clients = Client::orderBy('name')->get();
        return view('routines.edit', compact('routine', 'clients'));
    }

    /**
     * Update the specified routine in storage.
     */
    public function update(Request $request, Routine $routine)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
        ]);

        $routine->update($validated);

        return redirect()->route('routines.index')
            ->with('success', 'Rutina de entrenamiento actualizada correctamente.');
    }

    /**
     * Remove the specified routine from storage.
     */
    public function destroy(Routine $routine)
    {
        $routine->delete();

        return redirect()->route('routines.index')
            ->with('success', 'Rutina eliminada exitosamente.');
    }
}
