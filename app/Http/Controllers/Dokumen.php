<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dokumen as DokumenModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class Dokumen extends Controller
{
    /**
     * Views
     */
    public function tampilkan_dokumen($section, $id, $module_type): View
    {
        $documents = DokumenModel::where('reference_id', $id)->where('module', $module_type)->latest()->get();
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
    public function unggah_dokumen(Request $request, $reference_id = null)
    {
        try {
            $referrer = $request->headers->get('referer');
            $referrer_path = parse_url($referrer, PHP_URL_PATH);
            $url_segments = array_values(array_filter(explode('/', $referrer_path)));
            $section = $url_segments[0] ?? 'intelijen';
            $module_type = $url_segments[3] ?? $section;
            $valid_modules = ['intelijen', 'penyidikan', 'penindakan', 'monitoring'];
            if (!in_array($module_type, $valid_modules)) $module_type = $section;

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
            $storage_path = sprintf('dokumen/%s/%s/modul_%s', strtolower($section), $encoded_reference_id, strtolower($module_type));
            $file_name = sprintf('%s_%s_%s.%s', strtoupper($validated['tipe']), $safe_reference_id, now()->format('Ymd'), $file->getClientOriginalExtension());
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

            return redirect()->route('dokumen.show', [
                'section' => $section,
                'id' => rawurlencode($reference_id),
                'module_type' => $module_type
            ])->with('success', 'Dokumen berhasil diunggah!');
        } catch (ValidationException $e) {
            Log::error('Kesalahan validasi selama mengunggah:', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Kesalahan dalam mengunggah dokumen:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengunggah dokumen: ' . $e->getMessage()])->withInput();
        }
    }

    public function hapus_dokumen($id)
    {
        try {
            $document = DokumenModel::findOrFail($id);

            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Log::info("File ditemukan dan akan dihapus", ['id' => $id, 'path' => $document->file_path]);
            } else {
                Log::warning("File tidak ditemukan", ['id' => $id, 'path' => $document->file_path]);
            }

            $document->delete();
            return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
        } catch (Exception $e) {
            Log::error('Kesalahan saat menghapus dokumen:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus dokumen.');
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

            return response()->download($file_path, $document->tipe . '_' . basename($document->file_path));
        } catch (Exception $e) {
            Log::error('Kesalahan saat mengunduh dokumen:', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh dokumen.');
        }
    }
}