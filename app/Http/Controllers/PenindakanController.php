<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Penindakan;

class PenindakanController extends Controller
{
    public function index(Request $request): View
    {
        // Sample data
        $penindakanData = [
            [
                'no' => '1',
                'noSBP' => '123456',
                'tglSBP' => '22-09-2024',
                'lokasiPenindakan' => 'DSN DOKO RT 01 RW 01, KALIANYAR, KEC. KALIANYAR, KAB> BLITAR',
                'pelaku' => 'AGUS RIMBA',
                'uraianBHP' => 'ROKOK SMTH ILEGAL',
                'jmlh' => '20 (DUA PULUH) BAL',
                'kemasan' => 'BATANG',
                'nilaiBarang' => '10.000.000 (SEPULUH JUTA RUPIAH)',
                'potensiKurangbayar' => '-',
            ],
        ];

        $searchQuery = $request->input('search', '');

        $filteredData = collect($penindakanData)->filter(function ($item) use ($searchQuery) {
            if (empty($searchQuery)) return true;
            return collect($item)->some(function ($value) use ($searchQuery) {
                return stripos($value, $searchQuery) !== false;
            });
        })->values()->all();

        return view('penindakan.penindakan', [
            'penindakanData' => $filteredData,
            'searchQuery' => $searchQuery
        ]);
    }

}