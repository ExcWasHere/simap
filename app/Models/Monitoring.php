<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    public function intelijen()
    {
        return $this->belongsTo(Intelijen::class, 'no_nhi', 'no_nhi');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'reference_id', 'id');
    }
} 