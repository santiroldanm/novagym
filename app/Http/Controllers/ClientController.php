<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     */
    public function index()
    {
        // Fetch clients with their routines count
        $clients = Client::withCount('routines')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email|max:255',
            'phone' => 'nullable|string|max:50',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id(); // creator

        // Handle Photo (Supports both file upload and external URL)
        if ($request->hasFile('photo_file')) {
            $path = $request->file('photo_file')->store('clients', 'public');
            $data['photo'] = asset('storage/' . $path);
        } elseif (!empty($validated['photo_url'])) {
            $data['photo'] = $validated['photo_url'];
        } else {
            $data['photo'] = null;
        }

        Client::create($data);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente registrado exitosamente en la plataforma.');
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id . '|max:255',
            'phone' => 'nullable|string|max:50',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $validated;

        // Handle Photo update
        if ($request->hasFile('photo_file')) {
            // Delete old photo if it was a stored file
            if ($client->photo && str_contains($client->photo, 'storage/clients/')) {
                $oldPath = str_replace(asset('storage/'), '', $client->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo_file')->store('clients', 'public');
            $data['photo'] = asset('storage/' . $path);
        } elseif (!empty($validated['photo_url'])) {
            $data['photo'] = $validated['photo_url'];
        }

        $client->update($data);

        return redirect()->route('clients.index')
            ->with('success', 'Información del cliente actualizada exitosamente.');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(Client $client)
    {
        // Delete photo if it was stored locally
        if ($client->photo && str_contains($client->photo, 'storage/clients/')) {
            $oldPath = str_replace(asset('storage/'), '', $client->photo);
            Storage::disk('public')->delete($oldPath);
        }

        // Delete client (cascades routines in database level)
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente y todas sus rutinas asociadas han sido eliminados.');
    }
}
