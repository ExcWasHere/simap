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
    Route::get('/masuk', [Autentikasi::class, 'halaman_masuk'])->name('masuk');
    Route::get('/lupa-kata-sandi', [Autentikasi::class, 'halaman_lupa_kata_sandi'])->name('lupa-kata-sandi');
    Route::get('/reset-kata-sandi/{token}', [Autentikasi::class, 'halaman_reset_kata_sandi'])->name('password.reset');

    Route::post('/masuk', [Autentikasi::class, 'masuk'])->name('login');
    Route::post('/lupa-kata-sandi', [Autentikasi::class, 'lupa_kata_sandi'])->name('password.email');
    Route::post('/reset-kata-sandi', [Autentikasi::class, 'reset_kata_sandi'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    // Dasbor
    Route::get('/', [Autentikasi::class, 'halaman_beranda'])->name('dashboard');

    // Dokumen
    Route::get('/{section}/{id}/dokumen/{module_type}', [Dokumen::class, 'tampilkan_dokumen'])
        ->where('section', 'intelijen|penyidikan|penindakan|monitoring')
        ->where('module_type', 'intelijen|penyidikan|penindakan|monitoring')
        ->where('id', '.*')
        ->name('dokumen.show');
    Route::get('/dokumen/{id}/download', [Dokumen::class, 'unduh_dokumen'])->name('dokumen.unduh_dokumen');

    // Intelijen
    Route::prefix('intelijen')->group(function () {
        Route::get('/', [Intelijen::class, 'index'])->name('intelijen');
        Route::post('/', [Intelijen::class, 'store'])->name('intelijen.store');
        Route::get('/{no_nhi}/edit', [Intelijen::class, 'edit'])
            ->where('no_nhi', '.*')
            ->name('intelijen.edit');
        Route::put('/{no_nhi}', [Intelijen::class, 'update'])
            ->where('no_nhi', '.*')
            ->name('intelijen.update');
        Route::delete('/{no_nhi}', [Intelijen::class, 'destroy'])
            ->where('no_nhi', '.*')
            ->name('intelijen.destroy');
        Route::post('/{no_nhi}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])
            ->where('no_nhi', '.*')
            ->name('intelijen.upload.dokumen');
    });

    //  Monitoring BHP
    Route::prefix('monitoring')->group(function () {
        Route::get('/', [MonitoringBHP::class, 'show'])->name('monitoring');
        Route::get('/chart', [MonitoringBHP::class, 'show_chart'])->name('monitoring.chart');
        Route::get('/export/{type}', [MonitoringBHP::class, 'ekspor_excel'])->name('monitoring.export');
        Route::get('/chart-data', [MonitoringBHP::class, 'get_chart_data'])->name('monitoring.chart-data');
        Route::post('/{id}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('monitoring.upload.dokumen');
    });

    //  Penindakan
    Route::prefix('penindakan')->group(function () {
        Route::get('/', [Penindakan::class, 'show'])->name('penindakan');
        Route::post('/', [Penindakan::class, 'store'])->name('penindakan.store');
        Route::get('/{no_sbp}/edit', [Penindakan::class, 'edit'])
            ->where('no_sbp', '.*')
            ->name('penindakan.edit');
        Route::put('/{no_sbp}', [Penindakan::class, 'update'])
            ->where('no_sbp', '.*')
            ->name('penindakan.update');
        Route::delete('/{no_sbp}', [Penindakan::class, 'destroy'])
            ->where('no_sbp', '.*')
            ->name('penindakan.destroy');
        Route::post('/{no_sbp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])
            ->where('no_sbp', '.*')
            ->name('penindakan.upload.dokumen');
    });

    //  Penyidikan
    Route::prefix('penyidikan')->group(function () {
        Route::get('/', [Penyidikan::class, 'show'])->name('penyidikan');
        Route::post('/', [Penyidikan::class, 'store'])->name('penyidikan.store');
        Route::get('/{no_spdp}/edit', [Penyidikan::class, 'edit'])
            ->where('no_spdp', '.*')
            ->name('penyidikan.edit');
        Route::put('/{no_spdp}', [Penyidikan::class, 'update'])
            ->where('no_spdp', '.*')
            ->name('penyidikan.update');
        Route::delete('/{no_spdp}', [Penyidikan::class, 'destroy'])
            ->where('no_spdp', '.*')
            ->name('penyidikan.destroy');
        Route::post('/{no_spdp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])
            ->where('no_spdp', '.*')
            ->name('penyidikan.upload.dokumen');
    });

    // Tambah Data
    Route::prefix('tambah-data')->group(function () {
        Route::get('/intelijen', [Data::class, 'intelijen'])->name('tambah-data-intelijen');
        Route::get('/penindakan', [Data::class, 'penindakan'])->name('tambah-data-penindakan');
        Route::get('penyidikan', [Data::class, 'penyidikan'])->name('tambah-data-penyidikan');
    });

    // Aksi Dokumen Global
    Route::delete('/dokumen/{id}', [Dokumen::class, 'hapus_dokumen'])->name('dokumen.hapus_dokumen');

    //  Autentikasi dan Data
    Route::post('/keluar', [Autentikasi::class, 'keluar'])->name('keluar');

    //  Ekspor
    Route::get('/export/{section}', [Ekspor::class, 'export'])->name('export');
});