<?php

namespace App\Controllers;

use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Data;
use App\Http\Controllers\Dokumen;
use App\Http\Controllers\Ekspor;
use App\Http\Controllers\Intelijen;
use App\Http\Controllers\MonitoringBHP;
use App\Http\Controllers\Penindakan;
use App\Http\Controllers\Penyidikan;
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
    Route::prefix('intelijen')->group(function () {
        Route::get('/', [Intelijen::class, 'index'])->name('intelijen');
        Route::get('/{no_nhi}/dokumen', [Dokumen::class, 'halaman_intelijen'])->name('intelijen.dokumen');
        Route::get('/{no_nhi}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('intelijen.dokumen.upload');
        Route::post('/{no_nhi}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('intelijen.upload.dokumen');
        Route::get('/{no_nhi}/edit', [Intelijen::class, 'edit'])->name('intelijen.edit');
        Route::put('/{no_nhi}', [Intelijen::class, 'update'])->name('intelijen.update');
        Route::delete('/{no_nhi}', [Intelijen::class, 'destroy'])->name('intelijen.destroy');
    });

    //  Monitoring BHP
    Route::prefix('monitoring')->group(function () {
        Route::get('/', [MonitoringBHP::class, 'show'])->name('monitoring');
        Route::get('/{id}/dokumen', [Dokumen::class, 'halaman_monitoring'])->name('monitoring.dokumen');
        Route::get('/{id}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('monitoring.dokumen.upload');
        Route::post('/{id}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('monitoring.upload.dokumen');
        Route::get('/chart', [MonitoringBHP::class, 'show_chart'])->name('monitoring.chart');
        Route::get('/export/{type}', [MonitoringBHP::class, 'ekspor_excel'])->name('monitoring.export');
        Route::get('/chart-data', [MonitoringBHP::class, 'get_chart_data'])->name('monitoring.chart-data');
    });

    //  Penindakan
    Route::prefix('penindakan')->group(function () {
        Route::get('/', [Penindakan::class, 'index'])->name('penindakan');
        Route::get('/{no_sbp}/dokumen', [Dokumen::class, 'halaman_penindakan'])->name('penindakan.dokumen');
        Route::get('/{no_sbp}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('penindakan.dokumen.upload');
        Route::post('/{no_sbp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('penindakan.upload.dokumen');
        Route::get('/{no_sbp}/edit', [Penindakan::class, 'edit'])->name('penindakan.edit');
        Route::put('/{no_sbp}', [Penindakan::class, 'update'])->name('penindakan.update');
        Route::delete('/{no_sbp}', [Penindakan::class, 'destroy'])->name('penindakan.destroy');
    });

    //  Penyidikan
    Route::prefix('penyidikan')->group(function () {
        Route::get('/', [Penyidikan::class, 'index'])->name('penyidikan');
        Route::get('/{no_spdp}/dokumen', [Dokumen::class, 'halaman_penyidikan'])->name('penyidikan.dokumen');
        Route::get('/{no_spdp}/dokumen/upload', [Dokumen::class, 'halaman_unggah_dokumen'])->name('penyidikan.dokumen.upload');
        Route::post('/{no_spdp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('penyidikan.upload.dokumen');
        Route::get('/{no_spdp}/edit', [Penyidikan::class, 'edit'])->name('penyidikan.edit');
        Route::put('/{no_spdp}', [Penyidikan::class, 'update'])->name('penyidikan.update');
        Route::delete('/{no_spdp}', [Penyidikan::class, 'destroy'])->name('penyidikan.destroy');
    });

    // Tambah Data
    Route::prefix('tambah-data')->group(function () {
        Route::get('/intelijen', [Data::class, 'intelijen'])->name('tambah-data-intelijen');
        Route::get('/penindakan', [Data::class, 'penindakan'])->name('tambah-data-penindakan');
        Route::get('penyidikan', [Data::class, 'penyidikan'])->name('tambah-data-penyidikan');
    });

    // Aksi Dokumen Global
    Route::delete('/dokumen/{id}', [Dokumen::class, 'delete'])->name('dokumen.delete');

    //  Autentikasi dan Data
    Route::post('/data/store', [Data::class, 'store'])->name('data.store');
    Route::post('/logout', [Autentikasi::class, 'logout'])->name('logout');

    //  Ekspor
    Route::get('/export/{section}', [Ekspor::class, 'export'])->name('export');

    // Menghapus URL pada tabel
    Route::delete('/penyidikan/{no_spdp}', [Penyidikan::class, 'destroy'])->name('penyidikan.destroy');
    Route::delete('/penindakan/{no_sbp}', [Penindakan::class, 'destroy'])->name('penindakan.destroy');
});

// Password Reset
Route::post('/forgot-password', [Autentikasi::class, 'lupa_kata_sandi'])->name('password.email');