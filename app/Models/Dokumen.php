<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'sub_tipe',
        'tipe',
        'deskripsi',
        'file_path',
        'reference_id',
        'uploaded_by'
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function parent()
    {
        return match($this->tipe) {
            'intelijen' => $this->belongsTo(Intelijen::class, 'reference_id', 'no_nhi'),
            'penyidikan' => $this->belongsTo(Penyidikan::class, 'reference_id', 'no_spdp'),
            'penindakan' => $this->belongsTo(Penindakan::class, 'reference_id', 'no_sbp'),
            'monitoring' => $this->belongsTo(Intelijen::class, 'reference_id', 'no_nhi'),
            default => null
        };
    }
} 