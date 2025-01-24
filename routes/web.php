<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Penindakan;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [Admin::class, 'show'])->name('login');
    Route::post('/login', [Admin::class, 'login'])->middleware(['throttle:login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('');
    })->name('dashboard');

    Route::post('/logout', [Admin::class, 'logout'])->name('logout');
});

Route::get('/penindakan', [Penindakan::class, 'index'])->name('')->middleware('auth');