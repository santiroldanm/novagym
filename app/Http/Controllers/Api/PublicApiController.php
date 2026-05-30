<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Routine;
use App\Models\Instructor;

class PublicApiController extends Controller
{
    public function clients()
    {
        $clients = Client::select('id', 'name', 'email', 'status', 'created_at')->get();
        return response()->json([
            'success' => true,
            'count' => $clients->count(),
            'data' => $clients
        ]);
    }

    public function routines()
    {
        $routines = Routine::with(['client:id,name', 'instructor:id,name'])
            ->select('id', 'name', 'difficulty', 'client_id', 'instructor_id', 'created_at')
            ->get();
            
        return response()->json([
            'success' => true,
            'count' => $routines->count(),
            'data' => $routines
        ]);
    }

    public function instructors()
    {
        $instructors = Instructor::select('id', 'name', 'email', 'phone', 'specialty', 'status')->get();
        return response()->json([
            'success' => true,
            'count' => $instructors->count(),
            'data' => $instructors
        ]);
    }
}
