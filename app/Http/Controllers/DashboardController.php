<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Routine;
use App\Models\Membership;
use App\Models\MealPlan;
use App\Models\Branch;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard home with metrics and chart data.
     */
    public function index()
    {
        // 1. Core Metrics
        $totalClients = Client::count();
        $activeClients = Client::where('status', 'active')->count();
        $inactiveClients = Client::where('status', 'inactive')->count();
        $totalRoutines = Routine::count();

        // 2. New Metrics (Phase 2)
        $totalInstructors = Instructor::count();
        $totalBranches = Branch::where('status', 'active')->count();
        $activeMemberships = Membership::where('status', 'active')->count();
        $totalMealPlans = MealPlan::count();
        $totalRevenue = Membership::where('status', 'active')->sum('price');

        // 3. Client registration per month (Last 8 Months)
        $months = [];
        $counts = [];
        
        for ($i = 7; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->translatedFormat('M'); // e.g. "May", "Abr", etc.
            
            $count = Client::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $counts[] = $count;
        }

        // 4. Client registration per year (Last 5 Years)
        $years = [];
        $yearCounts = [];
        $currentYear = Carbon::now()->year;
        
        for ($i = 4; $i >= 0; $i--) {
            $year = $currentYear - $i;
            $years[] = (string)$year;
            
            $count = Client::whereYear('created_at', $year)->count();
            $yearCounts[] = $count;
        }

        // 5. Recent activity list (Simulated high-quality audit log)
        $recentActivities = [
            [
                'type' => 'routine',
                'title' => 'Nueva rutina asociada',
                'description' => 'Hipertrofia Funcional X asignada a Lucas Rivera.',
                'time' => 'Hace 15 min',
                'icon' => 'bolt',
                'color' => 'primary-container'
            ],
            [
                'type' => 'client',
                'title' => 'Socio nuevo registrado',
                'description' => 'Emilia Santillán ha sido registrada en el sistema.',
                'time' => 'Hace 2 horas',
                'icon' => 'person_add',
                'color' => 'primary-container'
            ],
            [
                'type' => 'routine',
                'title' => 'Nueva rutina creada',
                'description' => 'Acondicionamiento Nova H.I.I.T agregada por Admin.',
                'time' => 'Hace 3 horas',
                'icon' => 'fitness_center',
                'color' => 'primary-container'
            ]
        ];

        return view('dashboard', compact(
            'totalClients',
            'activeClients',
            'inactiveClients',
            'totalRoutines',
            'totalInstructors',
            'totalBranches',
            'activeMemberships',
            'totalMealPlans',
            'totalRevenue',
            'months',
            'counts',
            'years',
            'yearCounts',
            'recentActivities'
        ));
    }
}
