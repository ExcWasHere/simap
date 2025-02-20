<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dokumen as DokumenModel;
use App\Models\Penindakan as PenindakanModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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

        if ($date_from = $request->input('date_from')) $query->whereDate('tanggal_sbp', '>=', $date_from);
        if ($date_to = $request->input('date_to')) $query->whereDate('tanggal_sbp', '<=', $date_to);

        $perPage = $request->input('per_page', default: 5);
        $penindakan = $query->orderBy('no_sbp')->paginate($perPage)->appends($request->query());

        $rows = collect($penindakan->items())->map(function ($item, $index) use ($penindakan) {
            return [
                ($penindakan->currentPage() - 1) * $penindakan->perPage() + $index + 1,
                $item->no_sbp,
                $item->tanggal_sbp->format('d-m-Y'),
                $item->lokasi_penindakan,
                $item->pelaku,
                $item->uraian_bhp,
                $item->jumlah . ' ' . $item->kemasan,
                'Rp ' . number_format($item->perkiraan_nilai_barang, 0, ',', '.'),
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
            Log::info('Mencoba untuk menambahkan data penindakan', $request->all());

            $validated = $request->validate([
                // Data SBP (Surat Bukti Penindakan)
                'no_sbp' => ['required', 'string', 'max:255', 'unique:penindakan,no_sbp'],
                'tanggal_sbp' => ['required', 'date'],
                'tanggal_laporan' => ['required', 'date'],
                'no_print' => ['required', 'string', 'max:255'],
                'tanggal_print' => ['required', 'date'],

                // Informasi Barang
                'jenis_barang' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'kemasan' => ['required', 'string', 'max:255'],
                'perkiraan_nilai_barang' => ['required', 'numeric', 'min:0'],
                'potensi_kurang_bayar' => ['required', 'numeric', 'min:0'],

                // Lokasi dan Waktu Penindakan
                'lokasi_penindakan' => ['required', 'string'],
                'waktu_awal_penindakan' => ['required', 'date'],
                'waktu_akhir_penindakan' => ['required', 'date', 'after:waktu_awal_penindakan'],

                // Informasi Sarana Pengangkut
                'nama_jenis_sarkut' => ['required', 'string', 'max:255'],
                'pengemudi' => ['required', 'string', 'max:255'],
                'no_polisi' => ['required', 'string', 'max:255'],
                'bangunan' => ['required', 'string', 'max:255'],

                // Data Pelaku
                'pelaku' => ['required', 'string', 'max:255'],
                'nama_pemilik' => ['required', 'string', 'max:255'],
                'no_ktp' => ['required', 'string', 'max:20'],
                'no_hp' => ['required', 'string', 'max:20'],
                'tempat_lahir' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'pekerjaan' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string'],

                // Informasi Pelanggaran
                'jenis_pelanggaran' => ['required', 'string', 'max:255'],
                'pasal' => ['required', 'string', 'max:255'],


                // Data Petugas
                'petugas_1' => ['required', 'string', 'max:255'],
                'petugas_2' => ['required', 'string', 'max:255'],

                // Tanda Tangan
                'ttd_pelaku' => ['nullable', 'string'],
                'ttd_petugas_1' => ['nullable', 'string'],
                'ttd_petugas_2' => ['nullable', 'string'],
            ]);

            $validated['created_by'] = Auth::id();
            $penindakan = PenindakanModel::create($validated);
            $this->generate_sp_pdf($penindakan);
            DB::commit();

            return redirect()
                ->route('penindakan')
                ->with('success', 'Data penindakan berhasil disimpan!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Gagal untuk menambahkan data penindakan', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan data penindakan: ' . $e->getMessage()]);
        }
    }

    private function generate_sp_pdf(PenindakanModel $penindakan)
    {
        try {
            // Add debug logging untuk ttd
            Log::info('TTD Pelaku data:', [
                'ttd_exists' => !empty($penindakan->ttd_pelaku),
                'ttd_length' => strlen($penindakan->ttd_pelaku ?? ''),
                'ttd_preview' => substr($penindakan->ttd_pelaku ?? '', 0, 100)
            ]);

            $penindakan->load('creator', 'updater');
            $storagePath = sprintf('dokumen/penindakan/%s/modul_penindakan', rawurlencode($penindakan->no_sbp));

            setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'id');
            Carbon::setLocale('id');

            $documents = [
                [
                    'tipe' => 'SBP',
                    'deskripsi' => 'Surat Bukti Penindakan',
                    'view' => 'documents.surat-bukti-penindakan',
                    'priority' => 1
                ],
                [
                    'tipe' => 'BA-PENEGAHAN',
                    'deskripsi' => 'Berita Acara Penegahan',
                    'view' => 'documents.ba-penegahan',
                    'priority' => 2
                ],
                [
                    'tipe' => 'BA-PEMERIKSAAN',
                    'deskripsi' => 'Berita Acara Pemeriksaan',
                    'view' => 'documents.ba-pemeriksaan',
                    'priority' => 3
                ],
                [
                    'tipe' => 'LAMPIRAN-BA-PEMERIKSAAN',
                    'deskripsi' => 'Lampiran Berita Acara Pemeriksaan',
                    'view' => 'documents.lampiran-ba-pemeriksaan',
                    'priority' => 4
                ],
                [
                    'tipe' => 'BA-PENYEGELAN',
                    'deskripsi' => 'Berita Acara Penyegelan',
                    'view' => 'documents.ba-penyegelan',
                    'priority' => 5
                ],
                [
                    'tipe' => 'BA-PENCACAHAN',
                    'deskripsi' => 'Berita Acara Pencacahan',
                    'view' => 'documents.ba-pencacahan',
                    'priority' => 6
                ],
                [
                    'tipe' => 'LAMPIRAN-BA-PENCACAHAN',
                    'deskripsi' => 'Lampiran Berita Acara Pencacahan',
                    'view' => 'documents.lampiran-ba-pencacahan',
                    'priority' => 7
                ],
                [
                    'tipe' => 'BA-SERAH-TERIMA',
                    'deskripsi' => 'Berita Acara Serah Terima',
                    'view' => 'documents.berita-acara-serah-terima',
                    'priority' => 8
                ],
                [
                    'tipe' => 'SURAT-PERNYATAAN',
                    'deskripsi' => 'Surat Pernyataan',
                    'view' => 'documents.surat-pernyataan',
                    'priority' => 9
                ],
                [
                    'tipe' => 'BA-DOKUMENTASI',
                    'deskripsi' => 'Berita Acara Dokumentasi',
                    'view' => 'documents.ba-dokumentasi',
                    'priority' => 10
                ]
            ];

            usort($documents, fn($a, $b) => $a['priority'] <=> $b['priority']);
            $generatedDocuments = [];
            $now = now();

            foreach ($documents as $doc) {
                $pdf = Pdf::loadView($doc['view'], ['penindakan' => $penindakan]);
                $fileName = sprintf('%s_%s.pdf', $doc['tipe'], str_replace(['/', '\\'], '_', $penindakan->no_sbp));
                Storage::disk('public')->put($storagePath . '/' . $fileName, $pdf->output());

                $generatedDocuments[] = [
                    'tipe' => $doc['tipe'],
                    'deskripsi' => $doc['deskripsi'],
                    'file_path' => $storagePath . '/' . $fileName,
                    'reference_id' => $penindakan->no_sbp,
                    'uploaded_by' => Auth::id(),
                    'module' => 'penindakan',
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            DokumenModel::insert($generatedDocuments);

            Log::info('PDFs generated and stored successfully', [
                'no_sbp' => $penindakan->no_sbp,
                'storage_path' => $storagePath,
                'document_count' => count($documents)
            ]);
        } catch (Exception $e) {
            Log::error('Error generating PDFs: ' . $e->getMessage(), [
                'no_sbp' => $penindakan->no_sbp,
                'trace' => $e->getTraceAsString()
            ]);
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

            $penindakan->no_sbp .= $suffix;
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

            Log::info('Mencoba untuk mengupdate data penindakan', $request->all());

            if (!$no_sbp) throw new Exception('No. SBP tidak valid!');

            $penindakan = PenindakanModel::where('no_sbp', $no_sbp)->firstOrFail();

            $validated = $request->validate([
                // Data SBP (Surat Bukti Penindakan)
                'no_sbp' => ['required', 'string', 'max:255', 'unique:penindakan,no_sbp,' . $penindakan->id . ',id,deleted_at,NULL'],
                'tanggal_sbp' => ['required', 'date'],
                'tanggal_laporan' => ['required', 'date'],
                'no_print' => ['required', 'string', 'max:255'],
                'tanggal_print' => ['required', 'date'],

                // Informasi Barang
                'jenis_barang' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string', 'max:255'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'kemasan' => ['required', 'string', 'max:255'],
                'perkiraan_nilai_barang' => ['required', 'numeric', 'min:0'],
                'potensi_kurang_bayar' => ['required', 'numeric', 'min:0'],

                // Lokasi dan Waktu Penindakan
                'lokasi_penindakan' => ['required', 'string', 'max:255'],
                'waktu_awal_penindakan' => ['required', 'date'],
                'waktu_akhir_penindakan' => ['required', 'date', 'after:waktu_awal_penindakan'],

                // Informasi Sarana Pengangkut
                'nama_jenis_sarkut' => ['required', 'string', 'max:255'],
                'pengemudi' => ['required', 'string', 'max:255'],
                'no_polisi' => ['required', 'string', 'max:255'],
                'bangunan' => ['required', 'string', 'max:255'],

                // Data Pelaku
                'pelaku' => ['required', 'string', 'max:255'],
                'nama_pemilik' => ['required', 'string', 'max:255'],
                'no_ktp' => ['required', 'string', 'max:20'],
                'no_hp' => ['required', 'string', 'max:20'],
                'tempat_lahir' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'pekerjaan' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string'],

                // Informasi Pelanggaran
                'jenis_pelanggaran' => ['required', 'string', 'max:255'],
                'pasal' => ['required', 'string', 'max:255'],

                // Data Petugas
                'petugas_1' => ['required', 'string', 'max:255'],
                'petugas_2' => ['required', 'string', 'max:255'],

                // Tanda Tangan
                'ttd_pelaku' => ['nullable', 'string'],
                'ttd_petugas_1' => ['nullable', 'string'],
                'ttd_petugas_2' => ['nullable', 'string'],
            ]);

            $validated['updated_by'] = Auth::id();
            $penindakan->update($validated);
            $this->update_document($penindakan);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penindakan berhasil diperbarui!',
                'data' => $penindakan
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Gagal memperbarui data penindakan', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data penindakan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function update_document(PenindakanModel $penindakan)
    {
        $penindakan->dokumen()->delete();
        $this->generate_sp_pdf($penindakan);
    }
}
