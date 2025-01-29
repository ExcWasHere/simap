<?php

namespace App\Http\Controllers;

use App\Models\Intelijen;
use App\Models\Penindakan;
use App\Models\Penyidikan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ExportController extends BaseController
{
    public function export(Request $request, $section)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        switch ($section) {
            case 'intelijen':
                return $this->exportIntelijen($spreadsheet, $sheet);
            case 'penindakan':
                return $this->exportPenindakan($spreadsheet, $sheet);
            case 'penyidikan':
                return $this->exportPenyidikan($spreadsheet, $sheet);
            default:
                abort(404);
        }
    }

    private function exportIntelijen($spreadsheet, $sheet)
    {
        $headers = ['No', 'No NHI', 'Tanggal NHI', 'Tempat', 'Jenis Barang', 'Jumlah Barang', 'Keterangan'];
        $this->setHeaders($sheet, $headers);

        $data = Intelijen::orderBy('tanggal_nhi', 'desc')->get();
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

        return $this->downloadExcel($spreadsheet, 'intelijen');
    }

    private function exportPenindakan($spreadsheet, $sheet)
    {
        $headers = ['No', 'No SBP', 'Tanggal SBP', 'Lokasi', 'Pelaku', 'Uraian BHP', 'Jumlah', 'Nilai Barang', 'Potensi Kurang Bayar'];
        $this->setHeaders($sheet, $headers);

        $data = Penindakan::orderBy('tanggal_sbp', 'desc')->get();
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

        return $this->downloadExcel($spreadsheet, 'penindakan');
    }

    private function exportPenyidikan($spreadsheet, $sheet)
    {
        $headers = ['No', 'No SPDP', 'Tanggal SPDP', 'Pelaku', 'Keterangan'];
        $this->setHeaders($sheet, $headers);

        $data = Penyidikan::orderBy('tanggal_spdp', 'desc')->get();
        $row = 2;

        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_spdp);
            $sheet->setCellValue('C' . $row, $item->tanggal_spdp->format('d-m-Y'));
            $sheet->setCellValue('D' . $row, $item->pelaku);
            $sheet->setCellValue('E' . $row, $item->keterangan);
            $row++;
        }

        return $this->downloadExcel($spreadsheet, 'penyidikan');
    }

    private function setHeaders($sheet, $headers)
    {
        foreach (range('A', chr(64 + count($headers))) as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet->getStyle('A1:' . chr(64 + count($headers)) . '1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB']
            ]
        ]);
    }

    private function downloadExcel($spreadsheet, $section)
    {
        $writer = new Xlsx($spreadsheet);
        $filename = $section . '-' . date('Y-m-d') . '.xlsx';

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
} 