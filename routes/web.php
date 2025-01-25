<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\Intelijen;
use App\Http\Controllers\MonitoringBHP;
use App\Http\Controllers\Penindakan;
use App\Http\Controllers\Penyidikan;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [Admin::class, 'show'])->name('login');
    Route::post('/login', [Admin::class, 'login'])->name('login');
    Route::get('/lupa-kata-sandi', [ForgotPassword::class, 'show'])->name('forgot_password');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('pages.beranda');
    })->name('dashboard');

    Route::get('/penindakan', [Penindakan::class, 'index'])->name('penindakan');
    Route::get('/intelijen', [Intelijen::class, 'index'])->name('intelijen');
    Route::get('/penyidikan', [Penyidikan::class, 'index'])->name('penyidikan');
<<<<<<< HEAD
    Route::get('/monitoring-bhp', [MonitoringBHP::class, 'show'])->name('monitoring');
=======

    Route::get('/monitoring', [Monitoring::class, 'index'])->name('monitoring');

>>>>>>> f5807be794e587c6d58b9f947ea41930b40e602f
    Route::post('/logout', [Admin::class, 'logout'])->name('logout');
});