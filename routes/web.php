<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| The public route is the Landing Page, whereas all operational pages
| are strictly locked behind the 'auth' middleware.
|
*/

// 1. PUBLIC LANDING PAGE
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 2. GUEST AUTHENTICATION ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Forgot Password mockup (returns a premium UI response or action)
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});

// 3. PROTECTED SYSTEM ROUTES (AUTH REQUIRED)
Route::middleware('auth')->group(function () {
    // Session Termination
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clients CRUD Management
    Route::resource('clients', ClientController::class);

    // Routines CRUD Management
    Route::resource('routines', RoutineController::class);

    // Instructors CRUD Management
    Route::resource('instructors', InstructorController::class);

    // User Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});