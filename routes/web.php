<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

// Login routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');
        
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware(['throttle:login']) 
        ->name('login');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });


    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

