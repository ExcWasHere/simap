<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penindakan as PenindakanModel;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class Penindakan extends Controller
{
    public function show(Request $request): View
    {
        $query = PenindakanModel::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('no_sbp', 'like', "%{$search}%")
                    ->orWhere('lokasi_penindakan', 'like', "%{$search}%")
                    ->orWhere('pelaku', 'like', "%{$search}%")
                    ->orWhere('uraian_bhp', 'like', "%{$search}%");
            });
        }

        if ($date_from = $request->input('date_from')) 
            $query->whereDate('tanggal_sbp', '>=', $date_from);
        if ($date_to = $request->input('date_to')) 
            $query->whereDate('tanggal_sbp', '<=', $date_to);

        $perPage = $request->input('per_page', 10);
        $penindakan = $query->latest()->paginate($perPage)->withQueryString();

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
            'penindakan' => $penindakan
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'no_sbp' => ['required', 'string', 'max:255', 'unique:penindakan,no_sbp'],
                'tanggal_sbp' => ['required', 'date'],
                'lokasi_penindakan' => ['required', 'string'],
                'pelaku' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'kemasan' => ['required', 'string', 'max:255'],
                'perkiraan_nilai_barang' => ['required', 'numeric', 'min:0'],
                'potensi_kurang_bayar' => ['required', 'numeric', 'min:0'],
            ]);

            $validated['created_by'] = Auth::id();

            PenindakanModel::create($validated);
            DB::commit();

            return redirect()
                ->route('penindakan')
                ->with('success', 'Data penindakan berhasil disimpan');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in storing penindakan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan data penindakan: ' . $e->getMessage()]);
        }
    }

    public function destroy($no_sbp)
    {
        try {
            DB::beginTransaction();
            Log::info('Attempting to delete Penindakan record with no_sbp: ' . $no_sbp);

            $penindakan = PenindakanModel::whereNull('deleted_at')
                ->where('no_sbp', $no_sbp)
                ->firstOrFail();

            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";

            $penindakan->no_sbp = $penindakan->no_sbp . $suffix;
            $penindakan->save();
            $penindakan->delete();

            Log::info('Successfully deleted Penindakan record');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penindakan berhasil dihapus'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting penindakan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data penindakan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($no_sbp)
    {
        try {
            $penindakan = PenindakanModel::where('no_sbp', $no_sbp)->firstOrFail();

            return response()->json($penindakan);
        } catch (Exception $e) {
            Log::error('Error fetching penindakan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data penindakan'
            ], 500);
        }
    }

    public function update(Request $request, $no_sbp)
    {
        try {
            DB::beginTransaction();

            $penindakan = PenindakanModel::where('no_sbp', $no_sbp)->firstOrFail();

            $validated = $request->validate([
                'no_sbp' => ['required', 'string', 'max:255', 'unique:penindakan,no_sbp,' . $penindakan->id . ',id,deleted_at,NULL'],
                'tanggal_sbp' => ['required', 'date'],
                'lokasi_penindakan' => ['required', 'string', 'max:255'],
                'pelaku' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string', 'max:255'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'kemasan' => ['required', 'string', 'max:255'],
                'perkiraan_nilai_barang' => ['required', 'numeric', 'min:0'],
                'potensi_kurang_bayar' => ['required', 'numeric', 'min:0'],
            ]);

            $validated['updated_by'] = Auth::id();
            $penindakan->update($validated);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penindakan berhasil diperbarui',
                'data' => $penindakan
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in updating penindakan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data penindakan: ' . $e->getMessage()
            ], 500);
        }
    }
}