<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    /**
     * Display a listing of the instructors.
     */
    public function index()
    {
        $instructors = Instructor::withCount('clients')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('instructors.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new instructor.
     */
    public function create()
    {
        return view('instructors.create');
    }

    /**
     * Store a newly created instructor in storage.
     */
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
        $data['user_id'] = Auth::id(); // creator

        // Handle Photo (Supports both file upload and external URL)
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

    /**
     * Show the form for editing the specified instructor.
     */
    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    /**
     * Update the specified instructor in storage.
     */
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

        // Handle Photo update
        if ($request->hasFile('photo_file')) {
            // Delete old photo if it was a stored file
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

    /**
     * Remove the specified instructor from storage.
     */
    public function destroy(Instructor $instructor)
    {
        // Delete photo if it was stored locally
        if ($instructor->photo && str_contains($instructor->photo, 'storage/instructors/')) {
            $oldPath = str_replace(asset('storage/'), '', $instructor->photo);
            Storage::disk('public')->delete($oldPath);
        }

        $instructor->delete();

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor y sus datos asociados han sido eliminados.');
    }
}