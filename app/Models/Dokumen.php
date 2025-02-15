<?php

namespace App\Models;

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

        static::deleted(function ($dokumen) {
            try {
                Log::info("Mulai proses penghapusan dokumen", [
                    'id' => $dokumen->id,
                    'file_path' => $dokumen->file_path
                ]);

                if ($dokumen->file_path) {
                    if (Storage::disk('public')->exists($dokumen->file_path)) {
                        Storage::disk('public')->delete($dokumen->file_path);
                        Log::info("File berhasil dihapus", ['path' => $dokumen->file_path]);
                    }

                    $pathParts = explode('/', $dokumen->file_path);
                    array_pop($pathParts);
                    $currentPath = implode('/', $pathParts);

                    while ($currentPath && $currentPath !== 'dokumen') {
                        if (Storage::disk('public')->exists($currentPath)) {
                            $files = Storage::disk('public')->files($currentPath);
                            $directories = Storage::disk('public')->directories($currentPath);

                            Log::info("Memeriksa direktori", [
                                'path' => $currentPath,
                                'files' => count($files),
                                'directories' => count($directories)
                            ]);

                            if (empty($files) && empty($directories)) {
                                Storage::disk('public')->deleteDirectory($currentPath);
                                Log::info("Direktori kosong dihapus", ['path' => $currentPath]);
                            } else {
                                Log::info("Direktori masih berisi file/folder", ['path' => $currentPath]);
                                break; 
                            }
                        }

                        $pathParts = explode('/', $currentPath);
                        array_pop($pathParts);
                        $currentPath = implode('/', $pathParts);
                    }
                }
            } catch (\Exception $e) {
                Log::error("Error saat menghapus dokumen: " . $e->getMessage(), [
                    'id' => $dokumen->id,
                    'file_path' => $dokumen->file_path,
                    'trace' => $e->getTraceAsString()
                ]);
            }
        });

        static::forceDeleting(function ($dokumen) {
            try {
                Log::info("Mulai proses force delete dokumen", [
                    'id' => $dokumen->id,
                    'file_path' => $dokumen->file_path
                ]);

                if ($dokumen->file_path) {
                    if (Storage::disk('public')->exists($dokumen->file_path)) {
                        Storage::disk('public')->delete($dokumen->file_path);
                        Log::info("File berhasil dihapus", ['path' => $dokumen->file_path]);
                    }

                    $folderPath = dirname($dokumen->file_path);
                    $files = Storage::disk('public')->files($folderPath);
                    $directories = Storage::disk('public')->directories($folderPath);

                    if (empty($files) && empty($directories)) {
                        Storage::disk('public')->deleteDirectory($folderPath);
                        Log::info("Folder kosong dihapus", ['path' => $folderPath]);
                    }
                }
            } catch (\Exception $e) {
                Log::error("Error saat force delete dokumen: " . $e->getMessage(), [
                    'id' => $dokumen->id,
                    'file_path' => $dokumen->file_path,
                    'trace' => $e->getTraceAsString()
                ]);
            }
        });
    }
}
