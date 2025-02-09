<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Penindakan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penindakan';
    protected $primaryKey = 'no_sbp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_sbp',
        'tanggal_sbp',
        'lokasi_penindakan',
        'pelaku',
        'uraian_bhp',
        'jumlah',
        'kemasan',
        'perkiraan_nilai_barang',
        'potensi_kurang_bayar',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_sbp' => 'datetime',
        'status' => 'string',
        'perkiraan_nilai_barang' => 'decimal:2',
        'potensi_kurang_bayar' => 'decimal:2'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'no_sbp')->where('module', 'penindakan');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->dokumen()->each(function ($dokumen) {
                $dokumen->delete(); 
            });

            $storage_path = 'dokumen/penindakan/' . $model->no_sbp;
            if (Storage::disk('public')->exists($storage_path)) {
                Storage::disk('public')->deleteDirectory($storage_path);
            }

            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";

            $model->no_sbp = $model->no_sbp . $suffix;
            $model->save();
        });
    }
}