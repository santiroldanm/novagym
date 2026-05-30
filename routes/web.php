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
















Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'store'])->name('password.email');
    
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'store'])->name('password.update');
});


Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::resource('clients', ClientController::class);

    
    Route::resource('routines', RoutineController::class);
    Route::get('/routines/{routine}/pdf', [RoutineController::class, 'downloadPdf'])->name('routines.pdf');

    
    Route::resource('instructors', InstructorController::class);

    
    Route::resource('branches', BranchController::class);

    
    Route::resource('memberships', MembershipController::class);

    
    Route::resource('meal-plans', MealPlanController::class);
    Route::get('/meal-plans/{meal_plan}/pdf', [MealPlanController::class, 'downloadPdf'])->name('meal-plans.pdf');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});