<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Dokumen as DokumenModel;
use App\Models\Intelijen;
use App\Models\Penindakan;
use App\Models\Penyidikan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class Dokumen extends Controller
{
    /**
     * Views
     */
    public function halaman_intelijen(): View
    {
        return view('pages.dokumen-intelijen');
    }

    public function halaman_monitoring(): View
    {
        return view('pages.dokumen-monitoring');
    }

    public function halaman_penindakan(): View
    {
        return view('pages.dokumen-penindakan');
    }

    public function halaman_penyidikan(): View
    {
        return view('pages.dokumen-penyidikan');
    }

    public function halaman_unggah_dokumen(): View
    {
        return view('pages.unggah-dokumen');
    }


    /**
     * Middleware
     */
    public function intelijen(Request $request)
    {
        try {
            $content = $request->validate([
                'no_nhi' => ['required', 'digits:15'],
                'tempat' => ['required', 'string', 'max:255'],
                'jumlah_barang' => ['required', 'integer', 'min:1'],
                'tanggal_nhi' => ['required', 'date'],
                'jenis_barang' => ['required', 'string', 'max:255'],
                'keterangan' => ['nullable', 'string'],
            ]);

            Intelijen::create([
                'no_nhi' => $content['no_nhi'],
                'tempat' => $content['tempat'],
                'jumlah_barang' => $content['jumlah_barang'],
                'tanggal_nhi' => $content['tanggal_nhi'],
                'jenis_barang' => $content['jenis_barang'],
                'keterangan' => $content['keterangan'],
            ]);

            return response()->json(['Data intelijen berhasil disimpan.'], 201);
        } catch (Exception $exception) {
            Log::error('Error: ', ['error' => $exception->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan pada sistem.'], 500);
        }
    }

    public function penindakan(Request $request)
    {
        try {
            $content = $request->validate([
                'no_sbp' => ['required', 'string', 'max:255'],
                'lokasi_penindakan' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string', 'max:255'],
                'kemasan' => [''],
                'tanggal_sbp' => ['required', 'date'],
                'pelaku' => ['required', 'string', 'max:255'],
                'perkiraan_nilai_barang' => ['required', 'integer', 'min:1'],
                'potensi_kurang_bayar' => ['required', 'integer', 'min:1'],
            ]);

            Penindakan::create([
                'no_sbp' => $content['no_sbp'],
                'lokasi_penindakan' => $content['lokasi_penindakan'],
                'uraian_bhp' => $content['uraian_bhp'],
                'kemasan' => $content['kemasan'],
                'tanggal_sbp' => $content['tanggal_sbp'],
                'pelaku' => $content['pelaku'],
                'perkiraan_nilai_barang' => $content['perkiraan_nilai_barang'],
                'potensi_kurang_bayar' => $content['potensi_kurang_bayar'],
            ]);

            return response()->json(["Data penindakan berhasil disimpan."], 201);
        } catch (Exception $exception) {
            Log::error('Error: ', ['error' => $exception->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan pada sistem.'], 500);
        }
    }

    public function penyidikan(Request $request)
    {
        try {
            $content = $request->validate([
                'no_spdp' => ['required', 'string', 'max:255'],
                'pelaku' => ['required', 'string', 'max:255'],
                'tanggal_spdp' => ['required', 'date'],
                'keterangan' => ['nullable', 'string'],
            ]);

            Penyidikan::create([
                'no_spdp' => $content['no_spdp'],
                'pelaku' => $content['pelaku'],
                'tanggal_spdp' => $content['tanggal_spdp'],
                'keterangan' => $content['keterangan'],
            ]);

            return response()->json(['Data penyidikan berhasil disimpan.'], 201);
        } catch (Exception $exception) {
            Log::error('Error: ', ['error' => $exception->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan pada sistem.'], 500);
        }
    }

    public function unggah_dokumen(Request $request)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'tipe' => 'required|string',
                'deskripsi' => 'required|string',
                'file' => 'required|file|mimes:pdf|max:10240',
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $path = $file->storeAs('public/dokumen', $fileName);

            $dokumen = new DokumenModel();
            $dokumen->judul = $validated['judul'];
            $dokumen->tipe = $validated['tipe'];
            $dokumen->deskripsi = $validated['deskripsi'];
            $dokumen->file_path = $fileName;
            $dokumen->uploaded_by = auth()->id();
            $dokumen->save();

            return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            Log::error('Error uploading document: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat mengunggah dokumen.'])
                ->withInput();
        }
    }
}