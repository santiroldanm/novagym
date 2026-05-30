<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    


    public function index()
    {
        $branches = Branch::withCount('clients')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('branches.index', compact('branches'));
    }

    


    public function create()
    {
        return view('branches.create');
    }

    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'schedule' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Branch::create($validated);

        return redirect()->route('branches.index')
            ->with('success', 'Sede registrada exitosamente en la plataforma.');
    }

    


    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    


    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'schedule' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $branch->update($validated);

        return redirect()->route('branches.index')
            ->with('success', 'Información de la sede actualizada exitosamente.');
    }

    


    public function destroy(Branch $branch)
    {
        if ($branch->clients()->count() > 0) {
            return redirect()->route('branches.index')
                ->withErrors(['error' => 'No se puede eliminar la sede porque tiene clientes asociados.']);
        }

        $branch->delete();

        return redirect()->route('branches.index')
            ->with('success', 'Sede eliminada exitosamente.');
    }
}
