<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    


    public function index()
    {
        
        $clients = Client::with(['branch'])->withCount('routines')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clients.index', compact('clients'));
    }

    


    public function create()
    {
        $branches = \App\Models\Branch::where('status', 'active')->orderBy('name')->get();
        return view('clients.create', compact('branches'));
    }

    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email|max:255',
            'phone' => 'nullable|string|max:50',
            'branch_id' => 'nullable|exists:branches,id',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id(); 

        
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

    


    public function edit(Client $client)
    {
        $branches = \App\Models\Branch::where('status', 'active')->orderBy('name')->get();
        return view('clients.edit', compact('client', 'branches'));
    }

    


    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id . '|max:255',
            'phone' => 'nullable|string|max:50',
            'branch_id' => 'nullable|exists:branches,id',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photo_url' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $validated;

        
        if ($request->hasFile('photo_file')) {
            
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

    


    public function destroy(Client $client)
    {
        
        if ($client->photo && str_contains($client->photo, 'storage/clients/')) {
            $oldPath = str_replace(asset('storage/'), '', $client->photo);
            Storage::disk('public')->delete($oldPath);
        }

        
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente y todas sus rutinas asociadas han sido eliminados.');
    }
}
