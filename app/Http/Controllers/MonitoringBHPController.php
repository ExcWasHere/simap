<?php

namespace App\Http\Controllers;

use App\Models\Penindakan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MonitoringBHPController
{

    public function showChart()
    {
        return view('pages.monitoring-chart');
    }


    public function exportExcel($type)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No',
            'No SBP',
            'Tanggal SBP',
            'Lokasi Penindakan',
            'Pelaku',
            'Uraian BHP',
            'Jumlah',
            'Perkiraan Nilai Barang',
            'Potensi Kurang Bayar'
        ];

        foreach (range('A', 'I') as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $query = Penindakan::query();

        switch ($type) {
            case 'data-per-bulan':
                $query->whereMonth('tanggal_sbp', now()->month)
                    ->whereYear('tanggal_sbp', now()->year);
                break;
            case 'rekap-tahunan':
                $query->whereYear('tanggal_sbp', now()->year);
                break;
            case 'semua-data':
            default:
                break;
        }

        $data = $query->orderBy('tanggal_sbp', 'desc')->get();

        $row = 2;
        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_sbp);
            $sheet->setCellValue('C' . $row, $item->tanggal_sbp->format('d-m-Y'));
            $sheet->setCellValue('D' . $row, $item->lokasi_penindakan);
            $sheet->setCellValue('E' . $row, $item->pelaku);
            $sheet->setCellValue('F' . $row, $item->uraian_bhp);
            $sheet->setCellValue('G' . $row, $item->jumlah . ' ' . $item->kemasan);
            $sheet->setCellValue('H' . $row, number_format($item->perkiraan_nilai_barang, 0, ',', '.'));
            $sheet->setCellValue('I' . $row, $item->potensi_kurang_bayar ? number_format($item->potensi_kurang_bayar, 0, ',', '.') : '-');
            $row++;
        }

        // Apply styling to header row
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB']
            ]
        ]);

        $writer = new Xlsx($spreadsheet);
        $filename = 'monitoring-bhp-' . $type . '-' . now()->format('Y-m-d') . '.xlsx';

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0'
            ]
        );
    }

    public function getChartData(Request $request)
    {
        $range = $request->input('range', '7');
        $endDate = now();
        $startDate = match($range) {
            '30' => now()->subDays(29)->startOfDay(),
            '3' => now()->subMonths(3)->startOfDay(),
            '1' => now()->subYear()->startOfDay(),
            default => now()->subDays(6)->startOfDay(),
        };

        $intelijen = DB::table('intelijen')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $penindakan = DB::table('penindakan')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $penyidikan = DB::table('penyidikan')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $totalIntelijen = DB::table('intelijen')->count();
        $totalPenindakan = DB::table('penindakan')->count();
        $totalPenyidikan = DB::table('penyidikan')->count();
        $totalDokumen = $totalIntelijen + $totalPenindakan + $totalPenyidikan;

        // Hitung rata-rata per bulan
        $avgPerBulan = round(($totalDokumen / 12), 1); // Asumsi data 1 tahun

        // Hitung pertumbuhan
        $lastMonthCount = DB::table('intelijen')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count() +
            DB::table('penindakan')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count() +
            DB::table('penyidikan')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();

        $thisMonthCount = DB::table('intelijen')
            ->whereMonth('created_at', now()->month)
            ->count() +
            DB::table('penindakan')
            ->whereMonth('created_at', now()->month)
            ->count() +
            DB::table('penyidikan')
            ->whereMonth('created_at', now()->month)
            ->count();

        $pertumbuhan = $lastMonthCount > 0 
            ? round((($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 1)
            : 0;

        $dates = collect();
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dates->push($currentDate->format('Y-m-d'));
            $currentDate->addDay();
        }

        $chartData = [
            'labels' => $dates->map(fn($date) => Carbon::parse($date)->format('d M')),
            'datasets' => [
                [
                    'label' => 'Intelijen',
                    'data' => $dates->map(function($date) use ($intelijen) {
                        return $intelijen->firstWhere('date', $date)?->count ?? 0;
                    }),
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true
                ],
                [
                    'label' => 'Penindakan',
                    'data' => $dates->map(function($date) use ($penindakan) {
                        return $penindakan->firstWhere('date', $date)?->count ?? 0;
                    }),
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true
                ],
                [
                    'label' => 'Penyidikan',
                    'data' => $dates->map(function($date) use ($penyidikan) {
                        return $penyidikan->firstWhere('date', $date)?->count ?? 0;
                    }),
                    'borderColor' => '#F59E0B',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true
                ]
            ],
            'stats' => [
                'totalDokumen' => $totalDokumen,
                'pertumbuhan' => $pertumbuhan,
                'avgPerBulan' => $avgPerBulan
            ]
        ];

        return response()->json($chartData);
    }
}
