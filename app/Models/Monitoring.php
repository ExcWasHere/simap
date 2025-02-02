<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitoring extends Model
{
    public function intelijen(): BelongsTo
    {
        return $this->belongsTo(Intelijen::class, 'no_nhi', 'no_nhi');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'id');
    }
}