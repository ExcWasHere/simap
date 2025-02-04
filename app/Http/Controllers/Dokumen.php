<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dokumen as DokumenModel;
use App\Models\Intelijen as IntelijenModel;
use App\Models\Penindakan as PenindakanModel;
use App\Models\Penyidikan as PenyidikanModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class Dokumen extends Controller
{
    /**
     * Views
     */
    public function halaman_intelijen($no_nhi): View
    {
        $documents = DokumenModel::where('tipe', 'intelijen')
            ->where('reference_id', $no_nhi)
            ->latest()
            ->get();

        return view('pages.dokumen-intelijen', [
            'documents' => $documents,
            'no_nhi' => $no_nhi
        ]);
    }

    public function halaman_monitoring($id): View
    {
        $documents = DokumenModel::where('tipe', 'monitoring')
            ->where('reference_id', $id)
            ->latest()
            ->get();

        return view('pages.dokumen-monitoring', [
            'documents' => $documents,
            'id' => $id
        ]);
    }

    public function halaman_penindakan($no_sbp): View
    {
        $documents = DokumenModel::where('tipe', 'penindakan')
            ->where('reference_id', $no_sbp)
            ->latest()
            ->get();

        return view('pages.dokumen-penindakan', [
            'documents' => $documents,
            'no_sbp' => $no_sbp
        ]);
    }

    public function halaman_penyidikan($no_spdp): View
    {
        $documents = DokumenModel::where('tipe', 'penyidikan')
            ->where('reference_id', $no_spdp)
            ->latest()
            ->get();

        return view('pages.dokumen-penyidikan', [
            'documents' => $documents,
            'no_spdp' => $no_spdp
        ]);
    }

    public function halaman_unggah_dokumen($reference_id = null): View
    {
        $current_section = request()->segment(1);

        $reference_param = match ($current_section) {
            'intelijen' => 'no_nhi',
            'monitoring' => 'id',
            'penindakan' => 'no_sbp',
            'penyidikan' => 'no_spdp',
            default => null
        };

        Log::info('Upload page accessed:', [
            'section' => $current_section,
            'reference_id' => $reference_id,
            'reference_param' => $reference_param,
        ]);

        return view('pages.unggah-dokumen', [
            'reference_id' => $reference_id
        ]);
    }


    /**
     * Controllers
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

            IntelijenModel::create([
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

            PenindakanModel::create([
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

            PenyidikanModel::create([
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

    public function unggah_dokumen(Request $request, $reference_id = null)
    {
        try {
            $validated = $request->validate([
                'sub_tipe' => 'required|string|max:255',
                'tipe' => 'required|string|in:intelijen,monitoring,penindakan,penyidikan',
                'deskripsi' => 'nullable|string',
                'file' => 'required|file|mimes:pdf|max:10240',
            ]);

            $file = $request->file('file');

            $file_name = sprintf(
                '%s_%s_%s_%s.%s',
                strtoupper($validated['tipe']),
                $validated['sub_tipe'],
                $reference_id,
                now()->format('Ymd'),
                $file->getClientOriginalExtension()
            );

            $path = $file->storeAs('dokumen', $file_name, 'public');

            Log::info('Document upload reference ID:', [
                'request_data' => $request->all(),
                'route_reference_id' => $reference_id,
                'type' => $validated['tipe'],
                'filename' => $file_name
            ]);

            $dokumen = DokumenModel::create([
                'sub_tipe' => $validated['sub_tipe'],
                'tipe' => $validated['tipe'],
                'deskripsi' => $validated['deskripsi'],
                'file_path' => 'storage/' . $path,
                'reference_id' => $reference_id,
                'uploaded_by' => Auth::id()
            ]);

            Log::info('Document uploaded successfully:', [
                'id' => $dokumen->id,
                'type' => $dokumen->tipe,
                'sub_type' => $dokumen->sub_tipe,
                'reference_id' => $dokumen->reference_id,
                'file_path' => $dokumen->file_path
            ]);

            $redirect_route = match ($dokumen->tipe) {
                'intelijen' => 'intelijen.dokumen',
                'monitoring' => 'monitoring.dokumen',
                'penindakan' => 'penindakan.dokumen',
                'penyidikan' => 'penyidikan.dokumen',
                default => 'dashboard'
            };

            $redirect_params = [];
            if ($dokumen->reference_id) {
                $redirect_params = match ($dokumen->tipe) {
                    'intelijen' => ['no_nhi' => $dokumen->reference_id],
                    'monitoring' => ['id' => $dokumen->reference_id],
                    'penindakan' => ['no_sbp' => $dokumen->reference_id],
                    'penyidikan' => ['no_spdp' => $dokumen->reference_id],
                    default => []
                };
            }

            return redirect()->route($redirect_route, $redirect_params)->with('success', 'Dokumen berhasil diunggah!');
        } catch (ValidationException $e) {
            Log::error('Validation error during upload:', [
                'errors' => $e->errors()
            ]);
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            Log::error('Error uploading document:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat mengunggah dokumen: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $document = DokumenModel::findOrFail($id);
            $file_path = str_replace('storage/', '', $document->file_path);
            
            if (Storage::disk('public')->exists($file_path)) Storage::disk('public')->delete($file_path);
            $document->delete();

            return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
        } catch (Exception $e) {
            Log::error('Error deleting document:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus dokumen.');
        }
    }
}