<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyidikan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penyidikan';
    protected $primaryKey = 'no_spdp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_spdp',
        'intelijen_id',
        'tanggal_spdp',
        'pelaku',
        'keterangan',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_spdp' => 'datetime',
    ];

    public function intelijen(): BelongsTo
    {
        return $this->belongsTo(Intelijen::class, 'intelijen_id', 'no_nhi');
    }

    public function penindakan(): HasMany
    {
        return $this->hasMany(Penindakan::class, 'penyidikan_id', 'no_spdp');
    }

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

    protected static function booted()
    {
        static::created(function ($penyidikan) {
            if ($penyidikan->intelijen) {
                $penyidikan->intelijen->markAsProcessed();
            }
        });
    }
}