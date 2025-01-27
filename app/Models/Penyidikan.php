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
        'penindakan_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_spdp' => 'date',
    ];

    public function penindakan(): BelongsTo
    {
        return $this->belongsTo(Penindakan::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}