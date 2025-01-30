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
}
