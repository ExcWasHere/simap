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
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class Dokumen extends Controller
{
    /**
     * Views
     */
    public function halaman_dokumen($id, $tipe): View
    {
        $valid_types = ['intelijen', 'monitoring', 'penindakan', 'penyidikan'];
        abort_unless(in_array($tipe, $valid_types), 404);

        $documents = DokumenModel::where('tipe', $tipe)
            ->where('reference_id', $id)
            ->latest()
            ->get();

        return view("pages.dokumen-{$tipe}", [
            'documents' => $documents,
            'reference_id' => $id
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

        Log::info('Halaman unggah diakses:', [
            'section' => $current_section,
            'reference_id' => $reference_id,
            'reference_param' => $reference_param,
        ]);

        return view('pages.unggah-dokumen', [
            'reference_id' => $reference_id
        ]);
    }

    public function tampilkan_dokumen($section, $id, $module_type): View
    {
        $documents = DokumenModel::where('reference_id', $id)
            ->where('module', $module_type)
            ->latest()
            ->get();

        return view('pages.dokumen', [
            'documents' => $documents,
            'reference_id' => $id,
            'section' => $section,
            'module_type' => $module_type
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
            $referrer = $request->headers->get('referer');
            $referrer_path = parse_url($referrer, PHP_URL_PATH);
            $url_segments = array_values(array_filter(explode('/', $referrer_path)));
            
            $section = $url_segments[0] ?? 'intelijen';
            $module_type = $url_segments[3] ?? $section;

            $valid_modules = ['intelijen', 'penyidikan', 'penindakan', 'monitoring'];
            if (!in_array($module_type, $valid_modules)) {
                $module_type = $section;
            }

            Log::info('Konteks unggahan dokumen:', [
                'referrer' => $referrer,
                'url_segments' => $url_segments,
                'section' => $section,
                'module_type' => $module_type,
                'reference_id' => $reference_id
            ]);

            $validated = $request->validate([
                'tipe' => ['required', 'string'],
                'deskripsi' => 'nullable|string',
                'file' => 'required|file|mimes:pdf|max:10240',
            ]);

            $file = $request->file('file');

            $safe_reference_id = str_replace(['/', '\\'], '_', $reference_id);
            $encoded_reference_id = rawurlencode($reference_id);

            $storage_path = sprintf(
                'dokumen/%s/%s/modul_%s',
                strtolower($section),
                $encoded_reference_id,
                strtolower($module_type)
            );

            $file_name = sprintf(
                '%s_%s_%s.%s',
                strtoupper($validated['tipe']),
                $safe_reference_id,
                now()->format('Ymd'),
                $file->getClientOriginalExtension()
            );

            $path = $file->storeAs($storage_path, $file_name, 'public');

            Log::info('ID referensi unggahan dokumen:', [
                'request_data' => $request->all(),
                'route_reference_id' => $reference_id,
                'type' => $validated['tipe'],
                'filename' => $file_name,
                'section' => $section,
                'module_type' => $module_type,
                'storage_path' => $storage_path,
                'encoded_reference_id' => $encoded_reference_id
            ]);

            $dokumen = DokumenModel::create([
                'tipe' => $validated['tipe'],
                'deskripsi' => $validated['deskripsi'],
                'file_path' => $path,
                'reference_id' => $reference_id,
                'module' => $module_type,
                'uploaded_by' => Auth::id()
            ]);

            Log::info('Dokumen berhasil diunggah:', [
                'id' => $dokumen->id,
                'type' => $dokumen->tipe,
                'reference_id' => $dokumen->reference_id,
                'file_path' => $dokumen->file_path
            ]);

            return redirect()
                ->route('dokumen.show', [
                    'section' => $section,
                    'id' => rawurlencode($reference_id),
                    'module_type' => $module_type
                ])
                ->with('success', 'Dokumen berhasil diunggah!');

        } catch (ValidationException $e) {
            Log::error('Kesalahan validasi selama mengunggah:', [
                'errors' => $e->errors()
            ]);
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            Log::error('Kesalahan dalam mengunggah dokumen:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat mengunggah dokumen: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function hapus_dokumen($id)
    {
        try {
            $document = DokumenModel::findOrFail($id);
            $document->delete();

            return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
        } catch (Exception $e) {
            Log::error('Kesalahan saat menghapus dokumen:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus dokumen.');
        }
    }

    private function membersihkan_direktori_kosong(string $path)
    {
        try {
            while ($path && $path !== '.' && $path !== 'dokumen') {
                $storage = Storage::disk('public');
                
                $files = $storage->files($path);
                $directories = $storage->directories($path);

                if (empty($files) && empty($directories)) {
                    $storage->deleteDirectory($path);
                    Log::info('Menghapus direktori kosong:', ['path' => $path]);
                    
                    $path = dirname($path);
                } else {
                    break;
                }
            }
        } catch (Exception $e) {
            Log::error('Kesalahan saat membersihkan direktori:', [
                'path' => $path,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function unduh_dokumen($id)
    {
        try {
            $document = DokumenModel::findOrFail($id);
            $file_path = storage_path('app/public/' . $document->file_path);

            if (!file_exists($file_path)) throw new Exception('Berkas tidak ditemukan.');

            Log::info('Dokumen yang diunduh:', [
                'id' => $document->id,
                'file_path' => $document->file_path,
                'user_id' => Auth::id()
            ]);

            return response()->download(
                $file_path, 
                $document->tipe . '_' . basename($document->file_path)
            );
        } catch (Exception $e) {
            Log::error('Kesalahan saat mengunduh dokumen:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh dokumen.');
        }
    }
}