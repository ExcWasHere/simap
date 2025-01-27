<?php

namespace App\Http\Controllers;

use App\Models\Penindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringBHPController
{

    public function showChart()
    {
        return view('pages.monitoring-bhp-chart');
    }

    public function getChartData(Request $request)
    {
        $type = $request->input('type', 'line-chart-bulan');

        if ($type == 'line-chart-bulan') {
            return $this->getMonthlyData();
        }

        return $this->getYearlyData();
    }

    private function getMonthlyData()
    {
        $data = Penindakan::select(
            DB::raw('MONTH(tanggal_sbp) as bulan'),
            DB::raw('YEAR(tanggal_sbp) as tahun'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(perkiraan_nilai_barang) as total_nilai')
        )
        ->whereYear('tanggal_sbp', now()->year)
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun')
        ->orderBy('bulan')
        ->get();

        return response()->json([
            'labels' => $data->map(fn($item) => date("F", mktime(0, 0, 0, $item->bulan, 1))),
            'datasets' => [
                [
                    'label' => 'Jumlah Kasus',
                    'data' => $data->pluck('total'),
                    'borderColor' => '#4f46e5',
                    'tension' => 0.4
                ],
                [
                    'label' => 'Total Nilai (Juta Rupiah)',
                    'data' => $data->pluck('total_nilai'),
                    'borderColor' => '#818cf8',
                    'tension' => 0.4
                ]

            ]
        ]);
    }

    private function getYearlyData()
    {
        $data = Penindakan::select(
            DB::raw('YEAR(tanggal_sbp) as tahun'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(perkiraan_nilai_barang) as total_nilai')
        )
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->get();

        return response()->json([
            'labels' => $data->pluck('tahun'),
            'datasets' => [
                [
                    'label' => 'Jumlah Kasus',
                    'data' => $data->pluck('total'),
                    'borderColor' => '#4f46e5',
                    'tension' => 0.4
                ],
                [
                    'label' => 'Total Nilai (Juta Rupiah)',
                    'data' => $data->pluck('total_nilai'),
                    'borderColor' => '#818cf8',
                    'tension' => 0.4
                ]
            ]
        ]);
    }
}
