<?php

namespace App\Controllers;

use App\Controllers\Autentikasi;
use App\Controllers\Intelijen;
use App\Controllers\MonitoringBHP;
use App\Controllers\Penindakan;
use App\Controllers\Penyidikan;
use App\Http\Controllers\MonitoringBHPController;
use App\Http\Controllers\PenindakanController;
use App\Http\Controllers\PenyidikanController;
use App\Http\Controllers\IntelijenController;
use App\Http\Controllers\DataController;

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
    // Dashboard
    Route::get('/', [Autentikasi::class, 'halaman_beranda'])->name('dashboard');

    // Intelijen
    Route::prefix('intelijen')->group(function() {
        Route::get('/', [IntelijenController::class, 'index'])->name('intelijen');
        Route::get('/dokumen', [Dokumen::class, 'halaman_intelijen'])->name('intelijen.dokumen');
        Route::post('/', [Dokumen::class, 'intelijen']);
    });

    //  Monitoring BHP
    Route::prefix('monitoring-bhp')->group(function() {
        Route::get('/', [MonitoringBHP::class, 'show'])->name('monitoring_bhp');
        Route::get('/dokumen', [Dokumen::class, 'halaman_monitoring_bhp'])->name('monitoring_bhp.dokumen');
        Route::get('/chart', [MonitoringBHPController::class, 'showChart'])->name('monitoring_bhp.chart');
        Route::get('/export/{type}', [MonitoringBHPController::class, 'exportExcel'])->name('monitoring_bhp.export');
    });

    //  Penindakan
    Route::prefix('penindakan')->group(function() {
        Route::get('/', [PenindakanController::class, 'index'])->name('penindakan');
        Route::post('/', [PenindakanController::class, 'store'])->name('penindakan.store');
        Route::get('/dokumen', [Dokumen::class, 'halaman_penindakan'])->name('penindakan.dokumen');
    });

    //  Penyidikan
    Route::prefix('penyidikan')->group(function() {
        Route::get('/', [PenyidikanController::class, 'index'])->name('penyidikan');
        Route::post('/', [PenyidikanController::class, 'store'])->name('penyidikan.store');
        Route::get('/dokumen', [Dokumen::class, 'halaman_penyidikan'])->name('penyidikan.dokumen');
    });

    //  Upload Dokumen
    Route::get('/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('upload.dokumen');

    //  Data & Authentication
    Route::post('/data/store', [DataController::class, 'store'])->name('data.store');
    Route::post('/logout', [Autentikasi::class, 'logout'])->name('logout');
});