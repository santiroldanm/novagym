<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Routine;
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

        // 2. Client registration per month (Last 8 Months)
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

        // 3. Client registration per year (Last 5 Years)
        $years = [];
        $yearCounts = [];
        $currentYear = Carbon::now()->year;
        
        for ($i = 4; $i >= 0; $i--) {
            $year = $currentYear - $i;
            $years[] = (string)$year;
            
            $count = Client::whereYear('created_at', $year)->count();
            $yearCounts[] = $count;
        }

        // 3. Recent activity list (Simulated high-quality audit log)
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
            'months',
            'counts',
            'years',
            'yearCounts',
            'recentActivities'
        ));
    }
}
