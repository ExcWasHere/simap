<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class Penindakan extends Controller
{
    public function index(Request $request): View
    {
        $data_penindakan = [
            'no' => '1',
            'no_sbp' => '123456',
            'tanggal_sbp' => '22-09-2024',
            'lokasi_penindakan' => 'DSN DOKO RT 01 RW 01, KALIANYAR, KEC. KALIANYAR, KAB. BLITAR',
            'pelaku' => 'AGUS RIMBA',
            'uraian_bhp' => 'ROKOK SMTH ILEGAL',
            'jumlah' => '20 (DUA PULUH) BAL',
            'kemasan' => 'BATANG',
            'nilai_barang' => '10.000.000 (SEPULUH JUTA RUPIAH)',
            'potensi_kurang_bayar' => '-',
        ];

        $kueri_pencarian = $request->input('search', '-');

        $data_filter = collect($data_penindakan)->filter(function ($value) use ($kueri_pencarian) {
            return stripos($value, $kueri_pencarian) !== false;
        })->all();

        return view('pages.penindakan', [
            'data_penindakan' => $data_filter,
            'kueri_pencarian' => $kueri_pencarian,
        ]);
    }
}