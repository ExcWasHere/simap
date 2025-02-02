<?php

namespace App\Observers;

use App\Models\Intelijen as IntelijenModel;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Log;

class Intelijen
{
    public function updated(IntelijenModel $intelijen)
    {
        if ($intelijen->wasChanged('no_nhi')) {
            $oldNhi = $intelijen->getOriginal('no_nhi');
            $newNhi = $intelijen->no_nhi;

            Log::info("Memperbarui referensi untuk perubahan NHI dari {$oldNhi} ke {$newNhi}");

            Dokumen::where('tipe', 'intelijen')
                ->where('reference_id', $oldNhi)
                ->update(['reference_id' => $newNhi]);

        }
    }
}