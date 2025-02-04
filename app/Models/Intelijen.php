<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";

            $model->no_nhi = $model->no_nhi . $suffix;
            $model->save();
        });
    }
}