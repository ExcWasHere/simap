<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Dokumen extends Model
{
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

        static::deleting(function ($dokumen) {
            if ($dokumen->file_path) {
                $file_path = str_replace('storage/', '', $dokumen->file_path);
                
                if (Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }

                $module_dir = dirname($file_path); 
                $id_dir = dirname($module_dir);   
                $section_dir = dirname($id_dir);  

                $storage = Storage::disk('public');
                if ($storage->exists($module_dir) && empty($storage->files($module_dir)) && empty($storage->directories($module_dir))) {
                    $storage->deleteDirectory($module_dir);
                }

                if ($storage->exists($id_dir) && empty($storage->files($id_dir)) && empty($storage->directories($id_dir))) {
                    $storage->deleteDirectory($id_dir);
                }

                if ($storage->exists($section_dir) && empty($storage->files($section_dir)) && empty($storage->directories($section_dir))) {
                    $storage->deleteDirectory($section_dir);
                }
            }
        });
    }
}