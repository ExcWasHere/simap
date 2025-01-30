<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyidikan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penyidikan';

    protected $fillable = [
        'no_spdp',
        'tanggal_spdp',
        'pelaku',
        'keterangan',
        'intelijen_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_spdp' => 'date'
    ];

    public function intelijen()
    {
        return $this->belongsTo(Intelijen::class, 'no_nhi', 'no_nhi');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'no_spdp');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function booted()
    {
        static::created(function ($penyidikan) {
            if ($penyidikan->intelijen) {
                $penyidikan->intelijen->markAsProcessed();
            }
        });
    }
}