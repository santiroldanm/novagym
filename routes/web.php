<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MealPlanController;
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
    
    // Real Password Reset Flow
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'store'])->name('password.email');
    
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'store'])->name('password.update');
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
    Route::get('/routines/{routine}/pdf', [RoutineController::class, 'downloadPdf'])->name('routines.pdf');

    // Instructors CRUD Management
    Route::resource('instructors', InstructorController::class);

    // Branches (Sedes) CRUD Management
    Route::resource('branches', BranchController::class);

    // Memberships CRUD Management
    Route::resource('memberships', MembershipController::class);

    // Meal Plans (Planes de Alimentación) CRUD Management
    Route::resource('meal-plans', MealPlanController::class);
    Route::get('/meal-plans/{meal_plan}/pdf', [MealPlanController::class, 'downloadPdf'])->name('meal-plans.pdf');

    // User Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});