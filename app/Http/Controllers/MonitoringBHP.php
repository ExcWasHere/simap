<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penindakan as PenindakanModel;
use App\Models\Intelijen as IntelijenModel;
use App\Models\Penyidikan as PenyidikanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MonitoringBHP extends Controller
{
    /**
     * Views
     */
    public function show()
    {
        return view('pages.monitoring');
    }

    public function show_chart()
    {
        return view('pages.monitoring-chart');
    }


    /**
     * Controllers
     */
    public function ekspor_excel($type)
    {
        $spreadsheet = new Spreadsheet();

        // Sheet 1: Intelijen
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Intelijen');
        $headers = [
            'No',
            'No NHI',
            'Tanggal NHI',
            'Tempat',
            'Jenis Barang',
            'Jumlah Barang',
            'Keterangan'
        ];

        foreach (range('A', 'G') as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $query = IntelijenModel::query();
        switch ($type) {
            case 'data-per-bulan':
                $query->whereMonth('tanggal_nhi', now()->month)
                    ->whereYear('tanggal_nhi', now()->year);
                break;
            case 'rekap-tahunan':
                $query->whereYear('tanggal_nhi', now()->year);
                break;
            case 'semua-data':
            default:
                break;
        }

        $data = $query->orderBy('tanggal_nhi', 'desc')->get();
        $row = 2;
        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_nhi);
            $sheet->setCellValue('C' . $row, $item->tanggal_nhi->format('d-m-Y'));
            $sheet->setCellValue('D' . $row, $item->tempat);
            $sheet->setCellValue('E' . $row, $item->jenis_barang);
            $sheet->setCellValue('F' . $row, $item->jumlah_barang);
            $sheet->setCellValue('G' . $row, $item->keterangan);
            $row++;
        }

        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB']
            ]
        ]);

        // Sheet 2: Penyidikan
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Penyidikan');
        $headers = [
            'No',
            'No SPDP',
            'Tanggal SPDP',
            'Pelaku',
            'Keterangan'
        ];

        foreach (range('A', 'E') as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $query = PenyidikanModel::query();
        switch ($type) {
            case 'data-per-bulan':
                $query->whereMonth('tanggal_spdp', now()->month)
                    ->whereYear('tanggal_spdp', now()->year);
                break;
            case 'rekap-tahunan':
                $query->whereYear('tanggal_spdp', now()->year);
                break;
            case 'semua-data':
            default:
                break;
        }

        $data = $query->orderBy('tanggal_spdp', 'desc')->get();
        $row = 2;
        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_spdp);
            $sheet->setCellValue('C' . $row, $item->tanggal_spdp->format('d-m-Y'));
            $sheet->setCellValue('D' . $row, $item->pelaku);
            $sheet->setCellValue('E' . $row, $item->keterangan);
            $row++;
        }

        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB']
            ]
        ]);

        // Sheet 3: Penindakan
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Penindakan');
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

        $query = PenindakanModel::query();
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

        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB']
            ]
        ]);

        // Set the first sheet as active
        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);
        $file_name = 'monitoring-bhp-' . $type . '-' . now()->format('Y-m-d') . '.xlsx';

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $file_name . '"',
                'Cache-Control' => 'max-age=0'
            ]
        );
    }

    public function get_chart_data(Request $request)
    {
        $range = $request->input('range', '7');
        $end_date = now();
        $start_date = match ($range) {
            '30' => now()->subDays(29)->startOfDay(),
            '3' => now()->subMonths(3)->startOfDay(),
            '1' => now()->subYear()->startOfDay(),
            default => now()->subDays(6)->startOfDay(),
        };

        $intelijen = DB::table('intelijen')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereNull('deleted_at')
            ->groupBy('date')
            ->get();

        $penindakan = DB::table('penindakan')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereNull('deleted_at')
            ->groupBy('date')
            ->get();

        $penyidikan = DB::table('penyidikan')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereNull('deleted_at')
            ->groupBy('date')
            ->get();

        $total_intelijen = DB::table('intelijen')->whereNull('deleted_at')->count();
        $total_penindakan = DB::table('penindakan')->whereNull('deleted_at')->count();
        $total_penyidikan = DB::table('penyidikan')->whereNull('deleted_at')->count();
        $total_dokumen = $total_intelijen + $total_penindakan + $total_penyidikan;

        // Hitung rata-rata per bulan
        $average_per_month = round(($total_dokumen / 12), 1); // Asumsi data 1 tahun

        // Hitung pertumbuhan
        $last_month_count = DB::table('intelijen')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereNull('deleted_at')
            ->count() +
            DB::table('penindakan')
                ->whereMonth('created_at', now()->subMonth()->month)
                ->whereNull('deleted_at')
                ->count() +
            DB::table('penyidikan')
                ->whereMonth('created_at', now()->subMonth()->month)
                ->whereNull('deleted_at')
                ->count();

        $this_month_count = DB::table('intelijen')
            ->whereMonth('created_at', now()->month)
            ->whereNull('deleted_at')
            ->count() +
            DB::table('penindakan')
                ->whereMonth('created_at', now()->month)
                ->whereNull('deleted_at')
                ->count() +
            DB::table('penyidikan')
                ->whereMonth('created_at', now()->month)
                ->whereNull('deleted_at')
                ->count();

        $pertumbuhan = $last_month_count > 0
            ? round((($this_month_count - $last_month_count) / $last_month_count) * 100, 1)
            : 0;

        $dates = collect();
        $current_date = $start_date->copy();
        while ($current_date <= $end_date) {
            $dates->push($current_date->format('Y-m-d'));
            $current_date->addDay();
        }

        $chart_data = [
            'labels' => $dates->map(fn($date) => Carbon::parse($date)->format('d M')),
            'datasets' => [
                [
                    'label' => 'Intelijen',
                    'data' => $dates->map(function ($date) use ($intelijen) {
                        return $intelijen->firstWhere('date', $date)?->count ?? 0;
                    }),
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true
                ],
                [
                    'label' => 'Penindakan',
                    'data' => $dates->map(function ($date) use ($penindakan) {
                        return $penindakan->firstWhere('date', $date)?->count ?? 0;
                    }),
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true
                ],
                [
                    'label' => 'Penyidikan',
                    'data' => $dates->map(function ($date) use ($penyidikan) {
                        return $penyidikan->firstWhere('date', $date)?->count ?? 0;
                    }),
                    'borderColor' => '#F59E0B',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true
                ]
            ],
            'stats' => [
                'total_dokumen' => $total_dokumen,
                'pertumbuhan' => $pertumbuhan,
                'average_per_month' => $average_per_month
            ]
        ];

        return response()->json($chart_data);
    }
}