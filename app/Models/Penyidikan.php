<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Penyidikan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penyidikan';

    protected $fillable = [
        'no_spdp',
        'tanggal_spdp',
        'pelaku',
        'keterangan',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_spdp' => 'datetime',
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'no_spdp')->where('module', 'penyidikan');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->dokumen()->each(function ($dokumen) {
                $dokumen->delete(); 
            });

            $storage_path = 'dokumen/penyidikan/' . $model->no_spdp;
            if (Storage::disk('public')->exists($storage_path)) {
                Storage::disk('public')->deleteDirectory($storage_path);
            }

            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";

            $model->no_spdp = $model->no_spdp . $suffix;
            $model->save();
        });
    }
}