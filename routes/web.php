<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Penindakan;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [Admin::class, 'show'])->name('login');
    Route::post('/login', [Admin::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('pages.beranda');
    })->name('dashboard');

    Route::get('/penindakan', [Penindakan::class, 'index'])->name('penindakan');

    Route::get('/intelijen', [Intelijen::class, 'index'])->name('intelijen');

    Route::get('/penyidikan', [Penyidikan::class, 'index'])->name('penyidikan');

    Route::post('/logout', [Admin::class, 'logout'])->name('logout');
});