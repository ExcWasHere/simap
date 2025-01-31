<?php

namespace App\Http\Controllers;

use App\Models\Intelijen;
use App\Models\Penyidikan;
use App\Models\Penindakan;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class IntelijenController
{
    public function index(Request $request): View
    {
        $query = Intelijen::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('no_nhi', 'like', "%{$search}%")
                  ->orWhere('tempat', 'like', "%{$search}%")
                  ->orWhere('jenis_barang', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->whereDate('tanggal_nhi', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->whereDate('tanggal_nhi', '<=', $dateTo);
        }

        $intelijen = $query->latest()->paginate(10)->withQueryString();

        $rows = $intelijen->map(function ($item, $index) use ($intelijen) {
            return [
                ($intelijen->currentPage() - 1) * $intelijen->perPage() + $index + 1,
                $item->no_nhi,
                $item->tanggal_nhi->format('d-m-Y'),
                $item->tempat,
                $item->jenis_barang,
                $item->jumlah_barang,
                $item->keterangan,
            ];
        })->toArray();

        return view('pages.intelijen', [
            'rows' => $rows,
            'intelijen' => $intelijen,
        ]);
    }

    public function destroy($no_nhi)
    {
        try {
            DB::beginTransaction();
            
            $intelijen = Intelijen::with(['penyidikan.penindakan'])
                ->where('no_nhi', $no_nhi)
                ->firstOrFail();
            
            Log::info('Found Intelijen record with ID: ' . $no_nhi);
            
            $penyidikanIds = $intelijen->penyidikan->pluck('no_spdp')->toArray();
            
            Log::info('Found related Penyidikan records: ' . implode(', ', $penyidikanIds));
            
            $penindakanIds = [];
            if (!empty($penyidikanIds)) {
                $penindakanIds = Penindakan::whereIn('penyidikan_id', $penyidikanIds)
                    ->pluck('no_sbp')
                    ->toArray();
                
                Log::info('Found related Penindakan records: ' . implode(', ', $penindakanIds));
            }
            
            if (!empty($penindakanIds)) {
                foreach ($penindakanIds as $penindakanId) {
                    Dokumen::where('tipe', 'penindakan')
                           ->where('reference_id', $penindakanId)
                           ->delete();
                }
                Log::info('Deleted Penindakan documents');
                       
                Penindakan::whereIn('no_sbp', $penindakanIds)->delete();
                Log::info('Soft deleted Penindakan records');
            }
            
            if (!empty($penyidikanIds)) {
                foreach ($penyidikanIds as $penyidikanId) {
                    Dokumen::where('tipe', 'penyidikan')
                           ->where('reference_id', $penyidikanId)
                           ->delete();
                }
                Log::info('Deleted Penyidikan documents');
                       
                Penyidikan::whereIn('no_spdp', $penyidikanIds)->delete();
                Log::info('Soft deleted Penyidikan records');
            }
            
            Dokumen::where('tipe', 'intelijen')
                   ->where('reference_id', $no_nhi)
                   ->delete();
            Log::info('Deleted Intelijen documents');
            
            $intelijen->delete();
            Log::info('Soft deleted Intelijen record');
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Data intelijen dan semua data terkait berhasil dihapus',
                'deleted' => [
                    'intelijen' => $no_nhi,
                    'penyidikan' => $penyidikanIds,
                    'penindakan' => $penindakanIds
                ]
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in cascade deletion for intelijen: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data intelijen dan data terkait: ' . $e->getMessage()
            ], 500);
        }
    }
}

