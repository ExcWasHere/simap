<?php

namespace App\Http\Controllers;

use App\Models\Intelijen as IntelijenModel;
use App\Models\Penindakan as PenindakanModel;
use App\Models\Penyidikan as PenyidikanModel;
use Illuminate\Routing\Controller as BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ekspor extends BaseController
{
    public function ekspor($section)
    {
        switch ($section) {
            case 'intelijen':
                return $this->ekspor_intelijen(new Spreadsheet(), (new Spreadsheet())->getActiveSheet());
            case 'penindakan':
                return $this->ekspor_penindakan(new Spreadsheet(), (new Spreadsheet())->getActiveSheet());
            case 'penyidikan':
                return $this->ekspor_penyidikan(new Spreadsheet(), (new Spreadsheet())->getActiveSheet());
            default:
                abort(404);
        }
    }

    private function ekspor_intelijen($spreadsheet, $sheet)
    {
        $headers = ['No', 'No NHI', 'Tanggal NHI', 'Tempat', 'Jenis Barang', 'Jumlah Barang', 'Keterangan'];
        $this->set_headers($sheet, $headers);
        $data = IntelijenModel::orderBy('tanggal_nhi', 'desc')->get();
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

        return $this->unduh_excel($spreadsheet, 'intelijen');
    }

    private function ekspor_penindakan($spreadsheet, $sheet)
    {
        $headers = ['No', 'No SBP', 'Tanggal SBP', 'Lokasi', 'Pelaku', 'Uraian BHP', 'Jumlah', 'Nilai Barang', 'Potensi Kurang Bayar'];
        $this->set_headers($sheet, $headers);
        $data = PenindakanModel::orderBy('tanggal_sbp', 'desc')->get();
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

        return $this->unduh_excel($spreadsheet, 'penindakan');
    }

    private function ekspor_penyidikan($spreadsheet, $sheet)
    {
        $headers = ['No', 'No SPDP', 'Tanggal SPDP', 'Pelaku', 'Keterangan'];
        $this->set_headers($sheet, $headers);
        $data = PenyidikanModel::orderBy('tanggal_spdp', 'desc')->get();
        $row = 2;

        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->no_spdp);
            $sheet->setCellValue('C' . $row, $item->tanggal_spdp->format('d-m-Y'));
            $sheet->setCellValue('D' . $row, $item->pelaku);
            $sheet->setCellValue('E' . $row, $item->keterangan);
            $row++;
        }

        return $this->unduh_excel($spreadsheet, 'penyidikan');
    }

    private function set_headers($sheet, $headers)
    {
        foreach (range('A', chr(64 + count($headers))) as $index => $column) {
            $sheet->setCellValue($column . '1', $headers[$index]);
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet->getStyle('A1:' . chr(64 + count($headers)) . '1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'e5e7eb']]
        ]);
    }

    private function unduh_excel($spreadsheet, $section)
    {
        return response()->stream(
            fn() => (new Xlsx($spreadsheet))->save('php://output'),
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $section . '-' . date('Y-m-d') . '.xlsx' . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
}