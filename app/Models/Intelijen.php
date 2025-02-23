<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Intelijen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'intelijen';

    protected $fillable = [
        'no_nhi',
        'tanggal_nhi',
        'tempat',
        'jenis_barang',
        'jumlah_barang',
        'kemasan',
        'keterangan',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_nhi' => 'datetime',
        'status' => 'string',
        'kemasan' => 'string'
    ];

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'no_nhi')->where('module', 'intelijen');
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
            $model->dokumen()->each(fn($dokumen) => $dokumen->delete());
            $storage_path = 'dokumen/intelijen/' . $model->no_nhi;
            if (Storage::disk('public')->exists($storage_path)) Storage::disk('public')->deleteDirectory($storage_path);

            $model->no_nhi .= "_deleted_" . now()->format('YmdHis') . str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);;
            $model->save();
        });
    }
}