<?php

namespace App\Http\Controllers;

use App\Models\Penyidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PenyidikanController
{
    public function index(Request $request): View
    {
        $query = Penyidikan::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('no_spdp', 'like', "%{$search}%")
                    ->orWhere('pelaku', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->whereDate('tanggal_spdp', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->whereDate('tanggal_spdp', '<=', $dateTo);
        }

        $penyidikan = $query->with(['intelijen', 'penindakan'])->latest()->paginate(10)->withQueryString();

        $moduleIds = [];
        $rows = $penyidikan->map(function ($item, $index) use ($penyidikan, &$moduleIds) {
            $moduleIds[$index] = [
                'intelijen' => $item->intelijen->no_nhi,
                'penyidikan' => $item->no_spdp,
                'penindakan' => optional($item->penindakan->first())->no_sbp ?? null,
            ];

            return [
                ($penyidikan->currentPage() - 1) * $penyidikan->perPage() + $index + 1,
                $item->no_spdp,
                $item->tanggal_spdp->format('d-m-Y'),
                $item->pelaku,
                $item->keterangan,
            ];
        })->toArray();

        return view('pages.penyidikan', [
            'rows' => $rows,
            'penyidikan' => $penyidikan,
            'moduleIds' => $moduleIds
        ]);
    }

    public function destroy($no_spdp)
    {
        try {
            DB::beginTransaction();
            
            $penyidikan = Penyidikan::with('penindakan')
                ->whereNull('deleted_at')
                ->where('no_spdp', $no_spdp)
                ->firstOrFail();
            
            // Handle related penindakan records first
            foreach ($penyidikan->penindakan as $penindakan) {
                $timestamp = now()->format('YmdHis');
                $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
                $suffix = "_deleted_{$timestamp}{$random}";
                
                $penindakan->no_sbp = $penindakan->no_sbp . $suffix;
                $penindakan->save();
                $penindakan->delete();
            }
            
            // Now handle the penyidikan record
            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";
            
            $penyidikan->no_spdp = $penyidikan->no_spdp . $suffix;
            $penyidikan->save();
            $penyidikan->delete();
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Data penyidikan berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting penyidikan: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data penyidikan'
            ], 500);
        }
    }

    public function edit($no_spdp)
    {
        try {
            $penyidikan = Penyidikan::with('intelijen')
                ->where('no_spdp', $no_spdp)
                ->firstOrFail();
            return response()->json($penyidikan);
        } catch (\Exception $e) {
            Log::error('Error fetching penyidikan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data penyidikan'
            ], 500);
        }
    }

    public function update(Request $request, $no_spdp)
    {
        try {
            DB::beginTransaction();
            
            $penyidikan = Penyidikan::where('no_spdp', $no_spdp)->firstOrFail();
            
            $validated = $request->validate([
                'tanggal_spdp' => ['required', 'date'],
                'pelaku' => ['required', 'string', 'max:255'],
                'intelijen_id' => ['required', 'exists:intelijen,id'],
                'keterangan' => ['nullable', 'string'],
            ]);
            
            $validated['updated_by'] = auth()->id();
            
            $penyidikan->update($validated);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Data penyidikan berhasil diperbarui',
                'data' => $penyidikan
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in updating penyidikan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data penyidikan: ' . $e->getMessage()
            ], 500);
        }
    }
}
