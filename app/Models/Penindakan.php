<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penindakan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penindakan';

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
        'penyidikan_id',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_sbp' => 'date',
        'status' => 'string',
        'perkiraan_nilai_barang' => 'integer',
        'potensi_kurang_bayar' => 'integer'
    ];

    public function penyidikan(): BelongsTo
    {
        return $this->belongsTo(Penyidikan::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function isProcessable(): bool
    {
        return $this->status === 'open';
    }

    public function markAsProcessed(): void
    {
        $this->status = 'processed';
        $this->save();
    }

    public function intelijen()
    {
        return $this->belongsTo(Intelijen::class, 'no_nhi', 'no_nhi');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'no_sbp');
    }
}