<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penyidikan as PenyidikanModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class Penyidikan extends Controller
{
    public function index(Request $request): View
    {
        $query = PenyidikanModel::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('no_spdp', 'like', "%{$search}%")
                    ->orWhere('pelaku', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($date_from = $request->input('date_from'))
            $query->whereDate('tanggal_spdp', '>=', $date_from);
        if ($date_to = $request->input('date_to'))
            $query->whereDate('tanggal_spdp', '<=', $date_to);

        $penyidikan = $query->with(['intelijen', 'penindakan'])->latest()->paginate(10)->withQueryString();

        $id_modul = [];
        $rows = $penyidikan->map(function ($item, $index) use ($penyidikan, &$id_modul) {
            $id_modul[$index] = [
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
            'id_modul' => $id_modul
        ]);
    }

    public function destroy($no_spdp)
    {
        try {
            DB::beginTransaction();

            $penyidikan = PenyidikanModel::with('penindakan')
                ->whereNull('deleted_at')
                ->where('no_spdp', $no_spdp)
                ->firstOrFail();

            foreach ($penyidikan->penindakan as $penindakan) {
                $timestamp = now()->format('YmdHis');
                $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
                $suffix = "_deleted_{$timestamp}{$random}";

                $penindakan->no_sbp = $penindakan->no_sbp . $suffix;
                $penindakan->save();
                $penindakan->delete();
            }

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

        } catch (Exception $e) {
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
            Log::info('Attempting to find Penyidikan record with no_spdp: ' . $no_spdp);

            $penyidikan = PenyidikanModel::withTrashed()
                ->with('intelijen')
                ->where(function ($query) use ($no_spdp) {
                    $query->where('no_spdp', $no_spdp)
                        ->orWhere('no_spdp', 'LIKE', $no_spdp . '%')
                        ->orWhere('id', $no_spdp);
                })
                ->first();

            if (!$penyidikan) {
                Log::error('Penyidikan record not found with no_spdp: ' . $no_spdp);
                throw new Exception('Data penyidikan tidak ditemukan');
            }

            Log::info('Found Penyidikan record:', ['id' => $penyidikan->id, 'no_spdp' => $penyidikan->no_spdp]);
            return response()->json($penyidikan);
        } catch (Exception $e) {
            Log::error('Error fetching penyidikan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data penyidikan: ' . $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $no_spdp)
    {
        try {
            DB::beginTransaction();
            Log::info('Attempting to update Penyidikan with no_spdp: ' . $no_spdp);

            $penyidikan = is_numeric($no_spdp) ? PenyidikanModel::withTrashed()->find($no_spdp) : null;

            if (!$penyidikan) {
                $penyidikan = PenyidikanModel::withTrashed()
                    ->where(function ($query) use ($no_spdp) {
                        $baseNoSpdp = preg_replace('/_deleted_.*$/', '', $no_spdp);
                        $query->where('no_spdp', $no_spdp)
                            ->orWhere('no_spdp', 'LIKE', $baseNoSpdp . '_deleted_%');
                    })
                    ->first();
            }

            if (!$penyidikan) {
                Log::error('Penyidikan record not found for update with no_spdp: ' . $no_spdp);
                throw new Exception('Data penyidikan tidak ditemukan');
            }

            Log::info('Found Penyidikan record for update:', [
                'id' => $penyidikan->id,
                'no_spdp' => $penyidikan->no_spdp,
                'is_trashed' => $penyidikan->trashed()
            ]);

            $no_spdp_baru = $request->input('no_spdp');
            Log::info('Requested new no_spdp: ' . $no_spdp_baru);

            $duplicate_exists = PenyidikanModel::where('no_spdp', $no_spdp_baru)
                ->where('id', '!=', $penyidikan->id)
                ->whereNull('deleted_at')
                ->exists();

            if ($duplicate_exists) throw new Exception('Nomor SPDP sudah digunakan.');

            $validated = $request->validate([
                'no_spdp' => ['required', 'string', 'max:255'],
                'tanggal_spdp' => ['required', 'date'],
                'pelaku' => ['required', 'string', 'max:255'],
                'intelijen_id' => ['required', 'exists:intelijen,id'],
                'keterangan' => ['nullable', 'string'],
            ]);

            $validated['updated_by'] = Auth::id();

            if ($penyidikan->trashed()) {
                Log::info('Restoring trashed Penyidikan record');
                $penyidikan->restore();
            }

            Log::info('Updating Penyidikan record with new data');
            $penyidikan->fill($validated);
            $penyidikan->save();

            DB::commit();

            Log::info('Successfully updated Penyidikan record');
            return response()->json([
                'success' => true,
                'message' => 'Data penyidikan berhasil diperbarui',
                'data' => $penyidikan
            ]);

        } catch (Exception $e) {
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