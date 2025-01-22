<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

// Rute halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')
    ->middleware('guest');

// Rute autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    
});