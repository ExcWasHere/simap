<?php

namespace App\Http\Controllers;

use App\Models\Penindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PenindakanController
{
    public function index(Request $request): View
    {
        $query = Penindakan::query();
        
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('no_sbp', 'like', "%{$search}%")
                    ->orWhere('lokasi_penindakan', 'like', "%{$search}%")
                    ->orWhere('pelaku', 'like', "%{$search}%")
                    ->orWhere('uraian_bhp', 'like', "%{$search}%");
            });
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->whereDate('tanggal_sbp', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->whereDate('tanggal_sbp', '<=', $dateTo);
        }

        $penindakan = $query->latest()->paginate(10)->withQueryString();

        $rows = $penindakan->map(function ($item, $index) use ($penindakan) {
            return [
                ($penindakan->currentPage() - 1) * $penindakan->perPage() + $index + 1,
                $item->no_sbp,
                $item->tanggal_sbp->format('d-m-Y'),
                $item->lokasi_penindakan,
                $item->pelaku,
                $item->uraian_bhp,
                $item->jumlah . ' ' . $item->kemasan,
                'Rp ' . number_format($item->perkiraan_nilai_barang, 0, ',', '.'),
                $item->potensi_kurang_bayar ? 'Rp ' . number_format($item->potensi_kurang_bayar, 0, ',', '.') : '-',
            ];
        })->toArray();

        return view('pages.penindakan', [
            'rows' => $rows,
            'penindakan' => $penindakan,
        ]);
    }

    public function destroy($no_sbp)
    {
        try {
            DB::beginTransaction();
            
            $penindakan = Penindakan::where('no_sbp', $no_sbp)->firstOrFail();
            
            $penindakan->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Data penindakan berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting penindakan: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data penindakan'
            ], 500);
        }
    }
}
