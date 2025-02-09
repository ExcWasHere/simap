<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dokumen as DokumenModel;
use App\Models\Penindakan as PenindakanModel;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class Penindakan extends Controller
{
    /**
     * Views
     */
    public function show(Request $request): View
    {
        $query = PenindakanModel::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('no_sbp', 'like', "%{$search}%")
                    ->orWhere('lokasi_penindakan', 'like', "%{$search}%")
                    ->orWhere('pelaku', 'like', "%{$search}%")
                    ->orWhere('uraian_bhp', 'like', "%{$search}%");
            });
        }

        if ($date_from = $request->input('date_from'))  $query->whereDate('tanggal_sbp', '>=', $date_from);
        if ($date_to = $request->input('date_to')) $query->whereDate('tanggal_sbp', '<=', $date_to);

        $perPage = $request->input('per_page', default: 5);
        $penindakan = $query->latest()->paginate($perPage)->withQueryString();

        $rows = $penindakan->map(function ($item, $index) use ($penindakan) {
            return [
                ($penindakan->currentPage() - 1) * $penindakan->perPage() + $index + 1,
                $item->no_sbp,
                $item->tanggal_sbp->format('d-m-Y'),
                $item->lokasi_penindakan,
                $item->pelaku,
                $item->uraian_bhp,
                $item->jumlah . ' ' . $item->kemasan, 'Rp ' . number_format($item->perkiraan_nilai_barang, 0, ',', '.'),
                $item->potensi_kurang_bayar ? 'Rp ' . number_format($item->potensi_kurang_bayar, 0, ',', '.') : '-',
            ];
        })->toArray();

        return view('pages.penindakan', [
            'rows' => $rows,
            'penindakan' => $penindakan
        ]);
    }


    /**
     * Controllers
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'no_sbp' => ['required', 'string', 'max:255', 'unique:penindakan,no_sbp'],
                'tanggal_sbp' => ['required', 'date'],
                'tanggal_laporan' => ['required', 'date'],
                'lokasi_penindakan' => ['required', 'string'],
                'pelaku' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'kemasan' => ['required', 'string', 'max:255'],
                'perkiraan_nilai_barang' => ['required', 'numeric', 'min:0'],
                'potensi_kurang_bayar' => ['required', 'numeric', 'min:0'],
                'jenis_barang' => ['required', 'string', 'max:255'],
                'no_print' => ['required', 'string', 'max:255'],
                'tanggal_print' => ['required', 'date'],
                'nama_jenis_sarkut' => ['required', 'string', 'max:255'],
                'pengemudi' => ['required', 'string', 'max:255'],
                'no_polisi' => ['required', 'string', 'max:255'],
                'bangunan' => ['required', 'string', 'max:255'],
                'nama_pemilik' => ['required', 'string', 'max:255'],
                'no_ktp' => ['required', 'string', 'max:20'],
                'no_hp' => ['required', 'string', 'max:20'],
                'tempat_lahir' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'pekerjaan' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string'],
                'waktu_awal_penindakan' => ['required', 'date'],
                'waktu_akhir_penindakan' => ['required', 'date', 'after:waktu_awal_penindakan'],
                'jenis_pelanggaran' => ['required', 'string', 'max:255'],
                'pasal' => ['required', 'string', 'max:255'],
                'petugas_1' => ['required', 'string', 'max:255'],
                'petugas_2' => ['required', 'string', 'max:255'],
            ]);

            $validated['created_by'] = Auth::id();

            $penindakan = PenindakanModel::create($validated);

            $this->generateSpPdf($penindakan);

            DB::commit();

            return redirect()
                ->route('penindakan')
                ->with('success', 'Data penindakan berhasil disimpan!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan dalam menyimpan data penindakan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan data penindakan: ' . $e->getMessage()]);
        }
    }

    protected function generateSpPdf(PenindakanModel $penindakan)
    {
        try {
            $storagePath = sprintf(
                'dokumen/penindakan/%s/modul_penindakan',
                rawurlencode($penindakan->no_sbp)
            );

            //  SP PDF
            $pdf = Pdf::loadView('documents.sp', ['penindakan' => $penindakan]);
            $fileName = sprintf('SP_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp));
            $path = Storage::disk('public')->put(
                $storagePath . '/' . $fileName,
                $pdf->output()
            );

            //  Lampiran BA Pencacahan PDF
            $pdf = Pdf::loadView('documents.lampiran-ba-pencacahan', ['penindakan' => $penindakan]);
            $fileName = sprintf('LAMPIRAN-BA-PENCACAHAN_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp));
            $path = Storage::disk('public')->put(
                $storagePath . '/' . $fileName,
                $pdf->output()
            );

            //  Lampiran BA Pemeriksaan PDF
            $pdf = Pdf::loadView('documents.lampiran-ba-pemeriksaan', ['penindakan' => $penindakan]);
            $fileName = sprintf('LAMPIRAN-BA-PEMERIKSAAN_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp));
            $path = Storage::disk('public')->put(
                $storagePath . '/' . $fileName,
                $pdf->output()
            );

            // BA Pencacahan PDF 
            $pdf = Pdf::loadView('documents.ba-pencacahan', [
                'penindakan' => $penindakan
            ]);
            $fileName = sprintf('BA-PENCACAHAN_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp));
            $path = Storage::disk('public')->put(
                $storagePath . '/' . $fileName, 
                $pdf->output()
            );

            // Document records
            $documents = [
                [
                    'tipe' => 'SP',
                    'deskripsi' => 'Surat Pernyataan',
                    'file_path' => $storagePath . '/' . sprintf('SP_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp)),
                ],
                [
                    'tipe' => 'LAMPIRAN-BA-PENCACAHAN',
                    'deskripsi' => 'Lampiran Berita Acara Pencacahan',
                    'file_path' => $storagePath . '/' . sprintf('LAMPIRAN-BA-PENCACAHAN_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp)),
                ],
                [
                    'tipe' => 'LAMPIRAN-BA-PEMERIKSAAN',
                    'deskripsi' => 'Lampiran Berita Acara Pemeriksaan',
                    'file_path' => $storagePath . '/' . sprintf('LAMPIRAN-BA-PEMERIKSAAN_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp)),
                ],
                [
                    'tipe' => 'BA-PENCACAHAN',
                    'deskripsi' => 'Berita Acara Pencacahan',
                    'file_path' => $storagePath . '/' . sprintf('BA-PENCACAHAN_%s.pdf', str_replace(['/', '\\'], '_', $penindakan->no_sbp)),
                ]
            ];

            foreach ($documents as $doc) {
                DokumenModel::create([
                    'tipe' => $doc['tipe'],
                    'deskripsi' => $doc['deskripsi'],
                    'file_path' => $doc['file_path'],
                    'reference_id' => $penindakan->no_sbp,
                    'uploaded_by' => Auth::id(),
                    'module' => 'penindakan'
                ]);
            }

            Log::info('PDFs generated and stored successfully', [
                'no_sbp' => $penindakan->no_sbp,
                'storage_path' => $storagePath
            ]);
        } catch (Exception $e) {
            Log::error('Error generating PDFs: ' . $e->getMessage());
            throw $e;
        }
    }

    public function destroy($no_sbp)
    {
        try {
            DB::beginTransaction();
            Log::info('Mencoba menghapus catatan penindakan dengan No. SBP: ' . $no_sbp);

            $penindakan = PenindakanModel::whereNull('deleted_at')
                ->where('no_sbp', $no_sbp)
                ->firstOrFail();

            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";

            $penindakan->no_sbp = $penindakan->no_sbp . $suffix;
            $penindakan->save();
            $penindakan->delete();

            Log::info('Berhasil menghapus catatan penindakan.');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penindakan berhasil dihapus!'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan saat menghapus data penindakan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data penindakan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($no_sbp)
    {
        try {
            $penindakan = PenindakanModel::where('no_sbp', $no_sbp)->firstOrFail();
            return response()->json($penindakan);
        } catch (Exception $e) {
            Log::error('Kesalahan mengambil data penindakan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data penindakan.'
            ], 500);
        }
    }

    public function update(Request $request, $no_sbp)
    {
        try {
            DB::beginTransaction();
            $penindakan = PenindakanModel::where('no_sbp', $no_sbp)->firstOrFail();

            $validated = $request->validate([
                'no_sbp' => ['required', 'string', 'max:255', 'unique:penindakan,no_sbp,' . $penindakan->id . ',id,deleted_at,NULL'],
                'tanggal_sbp' => ['required', 'date'],
                'tanggal_laporan' => ['required', 'date'],
                'lokasi_penindakan' => ['required', 'string', 'max:255'],
                'pelaku' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string', 'max:255'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'kemasan' => ['required', 'string', 'max:255'],
                'perkiraan_nilai_barang' => ['required', 'numeric', 'min:0'],
                'potensi_kurang_bayar' => ['required', 'numeric', 'min:0'],
                'jenis_barang' => ['required', 'string', 'max:255'],
                'no_print' => ['required', 'string', 'max:255'],
                'tanggal_print' => ['required', 'date'],
                'nama_jenis_sarkut' => ['required', 'string', 'max:255'],
                'pengemudi' => ['required', 'string', 'max:255'],
                'no_polisi' => ['required', 'string', 'max:255'],
                'bangunan' => ['required', 'string', 'max:255'],
                'nama_pemilik' => ['required', 'string', 'max:255'],
                'no_ktp' => ['required', 'string', 'max:20'],
                'no_hp' => ['required', 'string', 'max:20'],
                'tempat_lahir' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'pekerjaan' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string'],
                'waktu_awal_penindakan' => ['required', 'date'],
                'waktu_akhir_penindakan' => ['required', 'date', 'after:waktu_awal_penindakan'],
                'jenis_pelanggaran' => ['required', 'string', 'max:255'],
                'pasal' => ['required', 'string', 'max:255'],
                'petugas_1' => ['required', 'string', 'max:255'],
                'petugas_2' => ['required', 'string', 'max:255'],
            ]);

            $validated['updated_by'] = Auth::id();
            $penindakan->update($validated);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penindakan berhasil diperbarui!',
                'data' => $penindakan
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan dalam memperbarui data penindakan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data penindakan: ' . $e->getMessage()
            ], 500);
        }
    }
}