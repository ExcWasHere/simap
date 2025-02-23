<?php

use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Dokumen;
use App\Http\Controllers\Ekspor;
use App\Http\Controllers\Intelijen;
use App\Http\Controllers\MonitoringBHP;
use App\Http\Controllers\Penindakan;
use App\Http\Controllers\Penyidikan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/masuk', fn() => view('pages.masuk'))->name('masuk');
    Route::get('/lupa-kata-sandi', fn() => view('pages.lupa-kata-sandi'))->name('lupa-kata-sandi');
    Route::get('/reset-kata-sandi/{token}', fn() => view('pages.reset-kata-sandi', ['token' => Request::route('token'), 'nip' => Request::query('nip')]))->name('password.reset');
    Route::post('/masuk', [Autentikasi::class, 'masuk'])->name('login');
    Route::post('/lupa-kata-sandi', [Autentikasi::class, 'lupa_kata_sandi'])->name('password.email');
    Route::post('/reset-kata-sandi', [Autentikasi::class, 'reset_kata_sandi'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    // Dasbor
    Route::get('/', fn() => view('pages.beranda'))->name('dashboard');

    // Dokumen
    Route::get('/{section}/{id}/dokumen/{module_type}', [Dokumen::class, 'tampilkan_dokumen'])
        ->where('section', 'intelijen|penyidikan|penindakan|monitoring')
        ->where('module_type', 'intelijen|penyidikan|penindakan|monitoring')
        ->where('id', '.*')
        ->name('dokumen.show');
    Route::get('/dokumen/{id}/download', [Dokumen::class, 'unduh_dokumen'])->name('dokumen.unduh_dokumen');
    Route::delete('/dokumen/{id}', [Dokumen::class, 'hapus_dokumen'])->name('dokumen.hapus_dokumen');

    // Intelijen
    Route::prefix('intelijen')->group(function () {
        Route::get('/', [Intelijen::class, 'index'])->name('intelijen');
        Route::get('/{no_nhi}/edit', [Intelijen::class, 'edit'])->where('no_nhi', '.*')->name('intelijen.edit');
        Route::post('/', [Intelijen::class, 'store'])->name('intelijen.store');
        Route::post('/{no_nhi}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->where('no_nhi', '.*')->name('intelijen.upload.dokumen');
        Route::put('/{no_nhi}', [Intelijen::class, 'update'])->where('no_nhi', '.*')->name('intelijen.update');
        Route::delete('/{no_nhi}', [Intelijen::class, 'destroy'])->where('no_nhi', '.*')->name('intelijen.destroy');
    });

    //  Monitoring BHP
    Route::prefix('monitoring')->group(function () {
        Route::get('/', fn() => view('pages.monitoring'))->name('monitoring');
        Route::get('/chart', fn() => view('pages.monitoring-chart'))->name('monitoring.chart');
        Route::get('/ekspor/{type}', [MonitoringBHP::class, 'ekspor_excel'])->name('monitoring.ekspor');
        Route::get('/chart-data', [MonitoringBHP::class, 'mendapatkan_data_grafik'])->name('monitoring.chart-data');
        Route::post('/{id}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->name('monitoring.upload.dokumen');
    });

    //  Penindakan
    Route::prefix('penindakan')->group(function () {
        Route::get('/', [Penindakan::class, 'show'])->name('penindakan');
        Route::get('/{no_sbp}/edit', [Penindakan::class, 'edit'])->where('no_sbp', '.*')->name('penindakan.edit');
        Route::post('/{no_sbp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->where('no_sbp', '.*')->name('penindakan.upload.dokumen');
        Route::post('/', [Penindakan::class, 'store'])->name('penindakan.store');
        Route::put('/{no_sbp}', [Penindakan::class, 'update'])->where('no_sbp', '.*')->name('penindakan.update');
        Route::delete('/{no_sbp}', [Penindakan::class, 'destroy'])->where('no_sbp', '.*')->name('penindakan.destroy');
    });

    //  Penyidikan
    Route::prefix('penyidikan')->group(function () {
        Route::get('/', [Penyidikan::class, 'show'])->name('penyidikan');
        Route::get('/{no_spdp}/edit', [Penyidikan::class, 'edit'])->where('no_spdp', '.*')->name('penyidikan.edit');
        Route::post('/', [Penyidikan::class, 'store'])->name('penyidikan.store');
        Route::post('/{no_spdp}/dokumen/upload', [Dokumen::class, 'unggah_dokumen'])->where('no_spdp', '.*')->name('penyidikan.upload.dokumen');
        Route::put('/{no_spdp}', [Penyidikan::class, 'update'])->where('no_spdp', '.*')->name('penyidikan.update');
        Route::delete('/{no_spdp}', [Penyidikan::class, 'destroy'])->where('no_spdp', '.*')->name('penyidikan.destroy');
    });

    // Tambah Data
    Route::prefix('tambah-data')->group(function () {
        Route::get('/intelijen', fn() => view('pages.tambah-data-intelijen'))->name('tambah-data-intelijen');
        Route::get('/penindakan', fn() => view('pages.tambah-data-penindakan'))->name('tambah-data-penindakan');
        Route::get('/penyidikan', fn() => view('pages.tambah-data-penyidikan'))->name('tambah-data-penyidikan');
    });

    //  Autentikasi dan Data
    Route::post('/keluar', [Autentikasi::class, 'keluar'])->name('keluar');

    //  Ekspor
    Route::get('/ekspor/{section}', [Ekspor::class, 'ekspor'])->name('ekspor');
});