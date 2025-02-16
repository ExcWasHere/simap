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
        $headers = ['No', 'No NHI', 'Tanggal NHI', 'Tempat', 'Jenis Barang', 'Jumlah Barang', 'Keterangan'];

        foreach (range('A', 'G') as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $query = IntelijenModel::query();
        switch ($type) {
            case 'data-per-bulan':
                $query->whereMonth('tanggal_nhi', now()->month)->whereYear('tanggal_nhi', now()->year);
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
        $headers = ['No', 'No SPDP', 'Tanggal SPDP', 'Pelaku', 'Keterangan'];

        foreach (range('A', 'E') as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $query = PenyidikanModel::query();
        switch ($type) {
            case 'data-per-bulan':
                $query->whereMonth('tanggal_spdp', now()->month)->whereYear('tanggal_spdp', now()->year);
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
        $headers = ['No', 'No SBP', 'Tanggal SBP', 'Lokasi Penindakan', 'Pelaku', 'Uraian BHP', 'Jumlah', 'Perkiraan Nilai Barang', 'Potensi Kurang Bayar'];

        foreach (range('A', 'I') as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $query = PenindakanModel::query();
        switch ($type) {
            case 'data-per-bulan':
                $query->whereMonth('tanggal_sbp', now()->month)->whereYear('tanggal_sbp', now()->year);
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
            $sheet->setCellValue('D' . $row, $item->tanggal_laporan->format('d-m-Y'));
            $sheet->setCellValue('E' . $row, $item->pelaku);
            $sheet->setCellValue('F' . $row, $item->lokasi_penindakan);
            $sheet->setCellValue('G' . $row, $item->uraian_bhp);
            $sheet->setCellValue('H' . $row, $item->jumlah . ' ' . $item->kemasan);
            $sheet->setCellValue('I' . $row, number_format($item->perkiraan_nilai_barang, 0, ',', '.'));
            $sheet->setCellValue('J' . $row, $item->potensi_kurang_bayar ? number_format($item->potensi_kurang_bayar, 0, ',', '.') : '-');
            $sheet->setCellValue('K' . $row, $item->jenis_barang);
            $sheet->setCellValue('L' . $row, $item->no_print);
            $sheet->setCellValue('M' . $row, $item->tanggal_print ? \Carbon\Carbon::parse($item->tanggal_print)->format('d-m-Y') : '-');
            $sheet->setCellValue('N' . $row, $item->nama_jenis_sarkut);
            $sheet->setCellValue('O' . $row, $item->pengemudi);
            $sheet->setCellValue('P' . $row, $item->no_polisi);
            $sheet->setCellValue('Q' . $row, $item->bangunan);
            $sheet->setCellValue('R' . $row, $item->nama_pemilik);
            $sheet->setCellValue('S' . $row, $item->no_ktp);
            $sheet->setCellValue('T' . $row, $item->no_hp);
            $sheet->setCellValue('U' . $row, $item->tempat_lahir);
            $sheet->setCellValue('V' . $row, $item->tanggal_lahir ? $item->tanggal_lahir->format('d-m-Y') : '-');
            $sheet->setCellValue('W' . $row, $item->pekerjaan);
            $sheet->setCellValue('X' . $row, $item->alamat);
            $sheet->setCellValue('Y' . $row, $item->waktu_awal_penindakan ? $item->waktu_awal_penindakan->format('d-m-Y H:i') : '-');
            $sheet->setCellValue('Z' . $row, $item->waktu_akhir_penindakan ? $item->waktu_akhir_penindakan->format('d-m-Y H:i') : '-');
            $sheet->setCellValue('AA' . $row, $item->jenis_pelanggaran);
            $sheet->setCellValue('AB' . $row, $item->pasal);
            $sheet->setCellValue('AC' . $row, $item->petugas_1);
            $sheet->setCellValue('AD' . $row, $item->petugas_2);
            $sheet->setCellValue('AE' . $row, $item->ttd_petugas_1);
            $sheet->setCellValue('AF' . $row, $item->ttd_petugas_2);
            $row++;
        }

        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB']
            ]
        ]);

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
            '3' => now()->subMonths(2)->startOfDay(),
            '1' => now()->subMonths(11)->startOfDay(),
            default => now()->subDays(6)->startOfDay(),
        };

        $date_format = ($range === '3' || $range === '1') ? 'DATE_FORMAT(created_at, "%Y-%m-01")' : 'DATE(created_at)';

        $intelijen = DB::table('intelijen')
            ->selectRaw($date_format . ' as date, COUNT(*) as count')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereNull('deleted_at')
            ->groupBy('date')
            ->get();

        $penindakan = DB::table('penindakan')
            ->selectRaw($date_format . ' as date, COUNT(*) as count')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereNull('deleted_at')
            ->groupBy('date')
            ->get();

        $penyidikan = DB::table('penyidikan')
            ->selectRaw($date_format . ' as date, COUNT(*) as count')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereNull('deleted_at')
            ->groupBy('date')
            ->get();

        $total_intelijen = DB::table('intelijen')->whereNull('deleted_at')->count();
        $total_penindakan = DB::table('penindakan')->whereNull('deleted_at')->count();
        $total_penyidikan = DB::table('penyidikan')->whereNull('deleted_at')->count();
        $total_dokumen = $total_intelijen + $total_penindakan + $total_penyidikan;

        $first_intelijen = DB::table('intelijen')->whereNull('deleted_at')->min('created_at');
        $first_penindakan = DB::table('penindakan')->whereNull('deleted_at')->min('created_at');
        $first_penyidikan = DB::table('penyidikan')->whereNull('deleted_at')->min('created_at');

        $first_date = collect([$first_intelijen, $first_penindakan, $first_penyidikan])->filter()->min();

        if ($first_date) {
            $months_diff = Carbon::parse($first_date)->diffInMonths(Carbon::now()) + 1;
            $average_per_month = $months_diff > 0  ? round(($total_dokumen / $months_diff), 1) : $total_dokumen;
        } else {
            $average_per_month = 0;
        }

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

        $pertumbuhan = $last_month_count > 0 ? round((($this_month_count - $last_month_count) / $last_month_count) * 100, 1) : 0;

        $dates = collect();
        $current_date = $start_date->copy();
        
        if ($range === '3' || $range === '1') {
            $current_date->startOfMonth();
            while ($current_date <= $end_date) {
                $dates->push($current_date->format('Y-m-01'));
                $current_date->addMonth();
            }
        } else {
            while ($current_date <= $end_date) {
                $dates->push($current_date->format('Y-m-d'));
                $current_date->addDay();
            }
        }

        $chart_data = [
            'labels' => $dates->map(function($date) use ($range) {
                $carbon_date = Carbon::parse($date);
                return $range === '1' || $range === '3' ? 
                    $carbon_date->format('M Y') : 
                    $carbon_date->format('d M');
            }),
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
