<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intelijen as IntelijenModel;
use App\Models\Penyidikan as PenyidikanModel;
use App\Models\Penindakan as PenindakanModel;
use App\Models\Dokumen;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Intelijen extends Controller
{
    public function index(Request $request): View
    {
        $query = IntelijenModel::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('no_nhi', 'like', "%{$search}%")
                    ->orWhere('tempat', 'like', "%{$search}%")
                    ->orWhere('jenis_barang', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($date_from = $request->input('date_from'))
            $query->whereDate('tanggal_nhi', '>=', $date_from);
        if ($date_to = $request->input('date_to'))
            $query->whereDate('tanggal_nhi', '<=', $date_to);

        $intelijen = $query->with('penyidikan.penindakan')->latest()->paginate(10)->withQueryString();

        $id_modul = [];
        $rows = $intelijen->map(function ($item, $index) use (&$id_modul, $intelijen) {
            $penyidikan = optional($item->penyidikan)->first();
            $penindakan = optional(optional($penyidikan)->penindakan)->first();

            $id_modul[$index] = [
                'intelijen' => $item->no_nhi,
                'penyidikan' => optional($penyidikan)->no_spdp,
                'penindakan' => optional($penindakan)->no_sbp,
            ];

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
            'id_modul' => $id_modul
        ]);
    }

    public function destroy($no_nhi)
    {
        try {
            DB::beginTransaction();

            $intelijen = IntelijenModel::with(['penyidikan.penindakan'])
                ->where('no_nhi', $no_nhi)
                ->firstOrFail();

            Log::info('Found Intelijen record with ID: ' . $no_nhi);

            $id_penyidikan = $intelijen->penyidikan->pluck('id')->toArray();
            $id_penindakan = [];

            foreach ($intelijen->penyidikan as $penyidikan) {
                $id_penindakan = array_merge(
                    $id_penindakan,
                    $penyidikan->penindakan->pluck('id')->toArray()
                );
            }

            Log::info('Found related Penyidikan records: ' . implode(', ', $id_penyidikan));
            Log::info('Found related Penindakan records: ' . implode(', ', $id_penindakan));

            if (!empty($id_penindakan)) {
                foreach ($id_penindakan as $id) {
                    Dokumen::where('tipe', 'penindakan')
                        ->where('reference_id', $id)
                        ->delete();
                }
                Log::info('Deleted Penindakan documents');

                PenindakanModel::whereIn('id', $id_penindakan)->delete();
                Log::info('Soft deleted Penindakan records');
            }

            if (!empty($id_penyidikan)) {
                foreach ($id_penyidikan as $id) {
                    Dokumen::where('tipe', 'penyidikan')
                        ->where('reference_id', $id)
                        ->delete();
                }
                Log::info('Deleted Penyidikan documents');
                PenyidikanModel::whereIn('id', $id_penyidikan)->delete();
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
                    'penyidikan' => $id_penyidikan,
                    'penindakan' => $id_penindakan
                ]
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in cascade deletion for intelijen: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data intelijen dan data terkait: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($no_nhi)
    {
        $intelijen = IntelijenModel::where('no_nhi', $no_nhi)->firstOrFail();
        return response()->json($intelijen);
    }

    public function update(Request $request, $no_nhi)
    {
        try {
            DB::beginTransaction();

            $intelijen = IntelijenModel::where('no_nhi', $no_nhi)->firstOrFail();

            $validated = $request->validate([
                'no_nhi' => ['required', 'string', 'max:255', 'unique:intelijen,no_nhi,' . $intelijen->id],
                'tempat' => ['required', 'string', 'max:255'],
                'jumlah_barang' => ['required', 'integer', 'min:1'],
                'tanggal_nhi' => ['required', 'date'],
                'jenis_barang' => ['required', 'string', 'max:255'],
                'keterangan' => ['nullable', 'string'],
            ]);

            $validated['updated_by'] = Auth::id();
            $intelijen->update($validated);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data intelijen berhasil diperbarui',
                'data' => $intelijen
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in updating intelijen: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data intelijen: ' . $e->getMessage()
            ], 500);
        }
    }
}