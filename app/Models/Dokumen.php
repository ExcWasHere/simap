<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class Dokumen extends Model
{
    use SoftDeletes;

    protected $table = 'dokumen';

    protected $fillable = [
        'tipe',
        'deskripsi',
        'file_path',
        'reference_id',
        'module',
        'uploaded_by'
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleted(fn($dokumen) => self::hapus_berkas($dokumen));
        static::forceDeleting(fn($dokumen) => self::hapus_berkas($dokumen, true));
    }

    private static function hapus_berkas($dokumen, $force = false)
    {
        try {
            Log::info(($force ? "Menghapus paksa" : "Menghapus") . " dokumen", ['id' => $dokumen->id, 'file_path' => $dokumen->file_path]);

            if (!$dokumen->file_path || !Storage::disk('public')->exists($dokumen->file_path)) {
                Log::warning("File tidak ditemukan", ['id' => $dokumen->id, 'path' => $dokumen->file_path]);
                return;
            }

            Storage::disk('public')->delete($dokumen->file_path);
            Log::info("File berhasil dihapus", ['path' => $dokumen->file_path]);
            self::membersihkan_direktori(dirname($dokumen->file_path));
        } catch (Exception $e) {
            Log::error("Error saat menghapus dokumen: " . $e->getMessage(), ['id' => $dokumen->id, 'file_path' => $dokumen->file_path, 'trace' => $e->getTraceAsString()]);
        }
    }

    private static function membersihkan_direktori($direktori)
    {
        while ($direktori && $direktori !== 'dokumen') {
            if (!Storage::disk('public')->exists($direktori)) return;

            if (!empty(Storage::disk('public')->files($direktori)) || !empty(Storage::disk('public')->directories($direktori))) {
                Log::info("Direktori masih berisi file/folder", ['path' => $direktori]);
                return;
            }

            Storage::disk('public')->deleteDirectory($direktori);
            Log::info("Direktori kosong dihapus", ['path' => $direktori]);
            $direktori = dirname($direktori);
        }
    }
}