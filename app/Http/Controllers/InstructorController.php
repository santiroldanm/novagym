<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    


    public function index()
    {
        $instructors = Instructor::withCount('clients')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('instructors.index', compact('instructors'));
    }

    


    public function create()
    {
        return view('instructors.create');
    }

    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email|max:255',
            'phone' => 'nullable|string|max:50',
            'specialty' => 'nullable|string|max:100',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id(); 

        
        if ($request->hasFile('photo_file')) {
            $path = $request->file('photo_file')->store('instructors', 'public');
            $data['photo'] = asset('storage/' . $path);
        } elseif (!empty($validated['photo_url'])) {
            $data['photo'] = $validated['photo_url'];
        } else {
            $data['photo'] = null;
        }

        Instructor::create($data);

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor registrado exitosamente en la plataforma.');
    }

    


    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    


    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email,' . $instructor->id . '|max:255',
            'phone' => 'nullable|string|max:50',
            'specialty' => 'nullable|string|max:100',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $validated;

        
        if ($request->hasFile('photo_file')) {
            
            if ($instructor->photo && str_contains($instructor->photo, 'storage/instructors/')) {
                $oldPath = str_replace(asset('storage/'), '', $instructor->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo_file')->store('instructors', 'public');
            $data['photo'] = asset('storage/' . $path);
        } elseif (!empty($validated['photo_url'])) {
            $data['photo'] = $validated['photo_url'];
        }

        $instructor->update($data);

        return redirect()->route('instructors.index')
            ->with('success', 'Información del instructor actualizada exitosamente.');
    }

    


    public function destroy(Instructor $instructor)
    {
        
        if ($instructor->photo && str_contains($instructor->photo, 'storage/instructors/')) {
            $oldPath = str_replace(asset('storage/'), '', $instructor->photo);
            Storage::disk('public')->delete($oldPath);
        }

        $instructor->delete();

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor y sus datos asociados han sido eliminados.');
    }
}