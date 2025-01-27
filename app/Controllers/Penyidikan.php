<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class Penyidikan extends Controller
{
    public function index(Request $request): View
    {
        $data_penindakan = [
            'no' => '1',
            'no_spdp' => '123456',
            'tanggal_spdp' => '22-09-2024',
            'pelaku' => 'AGUS RIMBA',
            'keterangan' => 'BERHASIL DIAMANKAN',
        ];

        $kueri_pencarian = $request->input('search', '-');

        $data_filter = collect($data_penindakan)->filter(function ($value) use ($kueri_pencarian) {
            return stripos($value, $kueri_pencarian) !== false;
        })->all();

        return view('pages.penyidikan', [
            'data_penyidikan' => $data_filter,
            'kueri_pencarian' => $kueri_pencarian,
        ]);
    }
}