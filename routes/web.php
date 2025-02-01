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
use App\Http\Controllers\ExportController;

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
        Route::get('/{no_nhi}/dokumen', [Dokumen::class, 'halaman_intelijen'])->name('intelijen.dokumen');
        Route::get('/{no_nhi}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('intelijen.dokumen.upload');
        Route::post('/{no_nhi}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('intelijen.upload.dokumen');
        Route::get('/{no_nhi}/edit', [IntelijenController::class, 'edit'])->name('intelijen.edit');
        Route::put('/{no_nhi}', [IntelijenController::class, 'update'])->name('intelijen.update');
        Route::delete('/{no_nhi}', [IntelijenController::class, 'destroy'])->name('intelijen.destroy');
    });

    //  Monitoring BHP
    Route::prefix('monitoring')->group(function() {
        Route::get('/', [Monitoring::class, 'show'])->name('monitoring');
        Route::get('/{id}/dokumen', [Dokumen::class, 'halaman_monitoring'])->name('monitoring.dokumen');
        Route::get('/{id}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('monitoring.dokumen.upload');
        Route::post('/{id}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('monitoring.upload.dokumen');
        Route::get('/chart', [MonitoringBHPController::class, 'showChart'])->name('monitoring.chart');
        Route::get('/export/{type}', [MonitoringBHPController::class, 'exportExcel'])->name('monitoring.export');
        Route::get('/chart-data', [MonitoringBHPController::class, 'getChartData'])->name('monitoring.chart-data');
    });

    //  Penindakan
    Route::prefix('penindakan')->group(function() {
        Route::get('/', [PenindakanController::class, 'index'])->name('penindakan');
        Route::get('/{no_sbp}/dokumen', [Dokumen::class, 'halaman_penindakan'])->name('penindakan.dokumen');
        Route::get('/{no_sbp}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('penindakan.dokumen.upload');
        Route::post('/{no_sbp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('penindakan.upload.dokumen');
        Route::get('/{no_sbp}/edit', [PenindakanController::class, 'edit'])->name('penindakan.edit');
        Route::put('/{no_sbp}', [PenindakanController::class, 'update'])->name('penindakan.update');
        Route::delete('/{no_sbp}', [PenindakanController::class, 'destroy'])->name('penindakan.destroy');
    });

    //  Penyidikan
    Route::prefix('penyidikan')->group(function() {
        Route::get('/', [PenyidikanController::class, 'index'])->name('penyidikan');
        Route::get('/{no_spdp}/dokumen', [Dokumen::class, 'halaman_penyidikan'])->name('penyidikan.dokumen');
        Route::get('/{no_spdp}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('penyidikan.dokumen.upload');
        Route::post('/{no_spdp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('penyidikan.upload.dokumen');
        Route::get('/{no_spdp}/edit', [PenyidikanController::class, 'edit'])->name('penyidikan.edit');
        Route::put('/{no_spdp}', [PenyidikanController::class, 'update'])->name('penyidikan.update');
        Route::delete('/{no_spdp}', [PenyidikanController::class, 'destroy'])->name('penyidikan.destroy');
    });

    // Global document actions
    Route::delete('/dokumen/{id}', [Dokumen::class, 'delete'])->name('dokumen.delete');

    //  Data & Authentication
    Route::post('/data/store', [DataController::class, 'store'])->name('data.store');
    Route::post('/logout', [Autentikasi::class, 'logout'])->name('logout');

    //  Export
    Route::get('/export/{section}', [ExportController::class, 'export'])->name('export');

    // Tambah Data
    Route::get('/tambah-data', function () {
        return view('pages.tambah-data');
    })->name('tambah-data');

    // Delete routes pada table
    Route::delete('/penyidikan/{no_spdp}', [PenyidikanController::class, 'destroy'])->name('penyidikan.destroy');
    Route::delete('/penindakan/{no_sbp}', [PenindakanController::class, 'destroy'])->name('penindakan.destroy');
});
