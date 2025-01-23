<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenindakanController;

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

// Penindakan routes
Route::get('/penindakan', [PenindakanController::class, 'index'])
     ->name('penindakan.penindakan')
     ->middleware('auth');

Route::get('/intelijen/{noIntelijen}', function ($noIntelijen) {
})->name('intelijen.show');

Route::get('/penyidikan/{noIntelijen}', function ($noIntelijen) {
})->name('penyidikan.show');

Route::get('/monitoring-bhp/{noIntelijen}', function ($noIntelijen) {
})->name('monitoring.show');