<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Client;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MembershipController extends Controller
{
    /**
     * Display a listing of the memberships.
     */
    public function index()
    {
        $memberships = Membership::with(['client', 'instructor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new membership.
     */
    public function create()
    {
        $clients = Client::where('status', 'active')->orderBy('name')->get();
        return view('memberships.create', compact('clients'));
    }

    /**
     * Store a newly created membership in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plan_name' => 'required|string|max:255',
            'plan_type' => 'required|in:monthly,quarterly,annual,custom',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled',
            'notes' => 'nullable|string',
        ]);

        $data = $validated;
        
        // Auto-calculate end_date based on plan_type if not provided manually
        $startDate = Carbon::parse($validated['start_date']);
        if (empty($validated['end_date'])) {
            if ($validated['plan_type'] === 'monthly') {
                $data['end_date'] = $startDate->copy()->addMonth()->toDateString();
            } elseif ($validated['plan_type'] === 'quarterly') {
                $data['end_date'] = $startDate->copy()->addMonths(3)->toDateString();
            } elseif ($validated['plan_type'] === 'annual') {
                $data['end_date'] = $startDate->copy()->addYear()->toDateString();
            } else {
                // custom must have end_date
                $data['end_date'] = $startDate->copy()->addMonth()->toDateString();
            }
        }

        // Get instructor_id if current logged-in user is an instructor
        $instructorId = null;
        if (Auth::check()) {
            $instructor = Auth::user()->instructor;
            if ($instructor) {
                $instructorId = $instructor->id;
            }
        }
        $data['instructor_id'] = $instructorId;

        Membership::create($data);

        return redirect()->route('memberships.index')
            ->with('success', 'Membresía asignada exitosamente al cliente.');
    }

    /**
     * Show the form for editing the specified membership.
     */
    public function edit(Membership $membership)
    {
        $clients = Client::orderBy('name')->get();
        return view('memberships.edit', compact('membership', 'clients'));
    }

    /**
     * Update the specified membership in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plan_name' => 'required|string|max:255',
            'plan_type' => 'required|in:monthly,quarterly,annual,custom',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled',
            'notes' => 'nullable|string',
        ]);

        $data = $validated;
        
        $startDate = Carbon::parse($validated['start_date']);
        if (empty($validated['end_date'])) {
            if ($validated['plan_type'] === 'monthly') {
                $data['end_date'] = $startDate->copy()->addMonth()->toDateString();
            } elseif ($validated['plan_type'] === 'quarterly') {
                $data['end_date'] = $startDate->copy()->addMonths(3)->toDateString();
            } elseif ($validated['plan_type'] === 'annual') {
                $data['end_date'] = $startDate->copy()->addYear()->toDateString();
            } else {
                $data['end_date'] = $startDate->copy()->addMonth()->toDateString();
            }
        }

        // Keep current instructor or update if current user is instructor
        if (Auth::check()) {
            $instructor = Auth::user()->instructor;
            if ($instructor) {
                $data['instructor_id'] = $instructor->id;
            }
        }

        $membership->update($data);

        return redirect()->route('memberships.index')
            ->with('success', 'Membresía actualizada exitosamente.');
    }

    /**
     * Remove the specified membership from storage.
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();

        return redirect()->route('memberships.index')
            ->with('success', 'Membresía eliminada exitosamente.');
    }
}
