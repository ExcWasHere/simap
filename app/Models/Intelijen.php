<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'keterangan',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'tanggal_nhi' => 'date',
        'status' => 'string'
    ];

    public function penindakan(): HasOne
    {
        return $this->hasOne(Penindakan::class, Penyidikan::class);
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
        $this->update(['status' => 'processed']);
    }

    public function markAsClosed(): void
    {
        $this->update(['status' => 'closed']);
    }
}