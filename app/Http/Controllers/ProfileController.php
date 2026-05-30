<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Client;

class ProfileController extends Controller
{
    


    public function edit()
    {
        $user = Auth::user();
        
        
        $instructor = Instructor::where('user_id', $user->id)->first();
        $client = Client::where('user_id', $user->id)->first();
        
        if ($instructor) {
            $type = 'instructor';
            $profile = $instructor;
            
            $clientsCount = $instructor->clients()->count();
            $routinesCount = $instructor->routines()->count();
            return view('profile.instructor.edit', compact('profile', 'type', 'clientsCount', 'routinesCount'));
        } elseif ($client) {
            $type = 'client';
            $profile = $client;
            
            $routinesCount = $client->routines()->count();
            return view('profile.client.edit', compact('profile', 'type', 'routinesCount'));
        } else {
            
            $type = 'admin';
            $profile = $user;
            $clientsCount = $user->clients()->count();
            return view('profile.edit', compact('profile', 'type', 'clientsCount'));
        }
    }

    


    public function update(Request $request)
    {
        $user = Auth::user();
        
        
        $instructor = Instructor::where('user_id', $user->id)->first();
        $client = Client::where('user_id', $user->id)->first();
        
        if ($instructor) {
            $this->validateInstructorUpdate($request, $instructor->id);
            $this->updateInstructor($request, $instructor);
            return redirect()->route('profile.edit')
                ->with('success', 'Tu perfil de instructor ha sido actualizado con éxito.');
        } elseif ($client) {
            $this->validateClientUpdate($request, $client->id);
            $this->updateClient($request, $client);
            return redirect()->route('profile.edit')
                ->with('success', 'Tu perfil de cliente ha sido actualizado con éxito.');
        } else {
            
            $this->validateAdminUpdate($request, $user->id);
            $this->updateAdmin($request, $user);
            return redirect()->route('profile.edit')
                ->with('success', 'Tu perfil de administrador ha sido actualizado con éxito.');
        }
    }
    
    
    protected function validateAdminUpdate(Request $request, $userId)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'current_password' => ['nullable', 'required_with:new_password', 'string'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
    }
    
    protected function validateInstructorUpdate(Request $request, $instructorId)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('instructors')->ignore($instructorId)],
            'phone' => ['nullable', 'string', 'max:50'],
            'specialty' => ['nullable', 'string', 'max:100'],
            'photo_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'photo_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
    
    protected function validateClientUpdate(Request $request, $clientId)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('clients')->ignore($clientId)],
            'phone' => ['nullable', 'string', 'max:50'],
            'photo_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'photo_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
    
    
    protected function updateAdmin(Request $request, $user)
    {
        $validated = $request->only('name', 'email');
        
        if (!empty($request->input('new_password'))) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'La contraseña actual ingresada es incorrecta.']);
            }
            $user->password = Hash::make($request->input('new_password'));
        }
        
        $user->fill($validated)->save();
    }
    
    protected function updateInstructor(Request $request, $instructor)
    {
        $validated = $request->only('name', 'email', 'phone', 'specialty', 'status');
        
        
        if ($request->hasFile('photo_file')) {
            
            if ($instructor->photo && str_contains($instructor->photo, 'storage/instructors/')) {
                $oldPath = str_replace(asset('storage/'), '', $instructor->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo_file')->store('instructors', 'public');
            $validated['photo'] = asset('storage/' . $path);
        } elseif (!empty($request->input('photo_url'))) {
            $validated['photo'] = $request->input('photo_url');
        } else {
            $validated['photo'] = $instructor->photo; 
        }
        
        $instructor->fill($validated)->save();
    }
    
    protected function updateClient(Request $request, $client)
    {
        $validated = $request->only('name', 'email', 'phone', 'status');
        
        
        if ($request->hasFile('photo_file')) {
            
            if ($client->photo && str_contains($client->photo, 'storage/clients/')) {
                $oldPath = str_replace(asset('storage/'), '', $client->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo_file')->store('clients', 'public');
            $validated['photo'] = asset('storage/' . $path);
        } elseif (!empty($request->input('photo_url'))) {
            $validated['photo'] = $request->input('photo_url');
        } else {
            $validated['photo'] = $client->photo; 
        }
        
        $client->fill($validated)->save();
    }
}