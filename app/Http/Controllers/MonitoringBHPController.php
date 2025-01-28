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
                $query->whereMonth('tanggal_sbp', Carbon::now()->month)
                    ->whereYear('tanggal_sbp', Carbon::now()->year);
                break;
            case 'data-per-tahun':
                $query->whereYear('tanggal_sbp', Carbon::now()->year);
                break;
            default:
                break;
        }

        $data = $query->orderBy('tanggal_sbp', 'desc')->get();

        $row = 2;
        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_sbp);
            $sheet->setCellValue('C' . $row, $item->tanggal_sbp);
            $sheet->setCellValue('D' . $row, $item->lokasi_penindakan);
            $sheet->setCellValue('E' . $row, $item->pelaku);
            $sheet->setCellValue('F' . $row, $item->uraian_bhp);
            $sheet->setCellValue('G' . $row, $item->jumlah);
            $sheet->setCellValue('H' . $row, number_format($item->perkiraan_nilai_barang, 0, ',', '.'));
            $sheet->setCellValue('I' . $row, $item->potensi_kurang_bayar ? number_format($item->potensi_kurang_bayar, 0, ',', '.') : '-');
            $row++;
        }

        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E5E7EB']
                ]
            ]
        ]);

        $writer = new Xlsx($spreadsheet);
        $filename = 'monitoring-bhp-' . $type . '.xlsx';

        response()->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        response()->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
        response()->headers->set('Cache-Control', 'max-age=0');

        $writer->save('php://output');
    }
}
