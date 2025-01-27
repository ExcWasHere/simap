<?php

namespace App\Controllers;

use App\Controllers\Autentikasi;
use App\Controllers\Intelijen;
use App\Controllers\MonitoringBHP;
use App\Controllers\Penindakan;
use App\Controllers\Penyidikan;
use App\Http\Controllers\PenindakanController;
use App\Http\Controllers\PenyidikanController;
use App\Http\Controllers\IntelijenController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [Autentikasi::class, 'halaman_login'])->name('login');
    Route::get('/lupa-kata-sandi', [Autentikasi::class, 'halaman_lupa_kata_sandi'])->name('lupa-kata-sandi');
    Route::get('/reset-kata-sandi', [Autentikasi::class, 'halaman_reset_kata_sandi'])->name('reset-kata-sandi');
    
    Route::post('/login', [Autentikasi::class, 'login']);
    Route::post('/lupa-kata-sandi', [Autentikasi::class, 'lupa_kata_sandi']);
    Route::post('/reset-kata-sandi', [Autentikasi::class, 'reset_kata_sandi']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [Autentikasi::class, 'halaman_beranda'])->name('dashboard');
    Route::get('/intelijen', [IntelijenController::class, 'index'])->name('intelijen');
    Route::get('/monitoring-bhp', [MonitoringBHP::class, 'show'])->name('monitoring');
    Route::get('/penindakan', [PenindakanController::class, 'index'])->name('penindakan');
    Route::get('/penyidikan', [PenyidikanController::class, 'index'])->name('penyidikan');
    Route::get('/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('upload.dokumen');
    Route::get('/intelijen/dokumen', [Dokumen::class, 'halaman_intelijen'])->name('intelijen.dokumen');
    Route::get('/monitoring-bhp/dokumen', [Dokumen::class, 'halaman_monitoring_bhp'])->name('monitoring_bhp.dokumen');
    Route::get('/penindakan/dokumen', [Dokumen::class, 'halaman_penindakan'])->name('penindakan.dokumen');
    Route::get('/penyidikan/dokumen', [Dokumen::class, 'halaman_penyidikan'])->name('penyidikan.dokumen');
    
    Route::post('/intelijen', [Dokumen::class, 'intelijen'])->name('');
    Route::post('/logout', [Autentikasi::class, 'logout'])->name('logout');
});