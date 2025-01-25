<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class Intelijen extends Controller
{
    public function index(Request $request): View
    {
        $data_penindakan = [
            'no' => '1',
            'no_nhi' => '123456',
            'tanggal_nhi' => '22-09-2024',
            'tempat' => 'DSN DOKO RT 01 RW 01, KALIANYAR, KEC. KALIANYAR, KAB. BLITAR',
            'jenis_barang' => 'ROKOK SMTH ILEGAL',
            'jumlah_barang' => '20 (DUA PULUH) BAL',
            'keterangan' => 'BERHASIL DIAMANKAN',
        ];

        $kueri_pencarian = $request->input('search', '-');

        $data_filter = collect($data_penindakan)->filter(function ($value) use ($kueri_pencarian) {
            return stripos($value, $kueri_pencarian) !== false;
        })->all();

        return view('pages.intelijen', [
            'data_intelijen' => $data_filter,
            'kueri_pencarian' => $kueri_pencarian,
        ]);
    }
}