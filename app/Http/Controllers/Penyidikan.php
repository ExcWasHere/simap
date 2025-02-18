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
    public function show(Request $request): View
    {
        $query = PenyidikanModel::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('no_spdp', 'like', "%{$search}%")
                    ->orWhere('pelaku', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($date_from = $request->input('date_from')) $query->whereDate('tanggal_spdp', '>=', $date_from);
        if ($date_to = $request->input('date_to')) $query->whereDate('tanggal_spdp', '<=', $date_to);

        $perPage = $request->input('per_page', 5);
        $penyidikan = $query->orderBy('no_spdp')->paginate($perPage)->appends($request->query());

        $rows = collect($penyidikan->items())->map(function ($item, $index) use ($penyidikan) {
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
            'penyidikan' => $penyidikan
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'no_spdp' => ['required', 'string', 'max:255', 'unique:penyidikan,no_spdp'],
                'tanggal_spdp' => ['required', 'date'],
                'pelaku' => ['required', 'string', 'max:255'],
                'penyidikan_keterangan' => ['nullable', 'string'],
            ]);

            $validated['keterangan'] = $validated['penyidikan_keterangan'] ?? null;
            unset($validated['penyidikan_keterangan']);
            $validated['created_by'] = Auth::id();

            PenyidikanModel::create($validated);
            DB::commit();

            return redirect()
                ->route('penyidikan')
                ->with('success', 'Data penyidikan berhasil disimpan!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan dalam menyimpan data penyidikan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan data penyidikan: ' . $e->getMessage()]);
        }
    }

    public function destroy($no_spdp)
    {
        try {
            DB::beginTransaction();

            $penyidikan = PenyidikanModel::whereNull('deleted_at')
                ->where('no_spdp', $no_spdp)
                ->firstOrFail();

            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";

            $penyidikan->no_spdp = $penyidikan->no_spdp . $suffix;
            $penyidikan->save();
            $penyidikan->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penyidikan berhasil dihapus!'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting penyidikan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data penyidikan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($no_spdp)
    {
        try {
            Log::info('Mulai mengedit untuk data penyidikan: ', [
                'no_spdp' => $no_spdp,
                'type' => gettype($no_spdp)
            ]);

            if (is_numeric($no_spdp)) {
                Log::info('Mencoba mencari berdasarkan ID...');
                $penyidikan = PenyidikanModel::withTrashed()->find($no_spdp);
                if ($penyidikan) Log::info('Catatan yang ditemukan dengan ID: ', ['id' => $penyidikan->id]);
            }
            
            if (!isset($penyidikan) || !$penyidikan) {
                Log::info('Mencoba mencari dengan No. SPDP atau pola unik...');
                $penyidikan = PenyidikanModel::withTrashed()
                    ->where(function ($query) use ($no_spdp) {
                        $query->where('no_spdp', $no_spdp)->orWhere('no_spdp', 'LIKE', $no_spdp . '%');
                    })
                    ->first();
            }

            if (!$penyidikan) {
                Log::error('Catatan penyidikan tidak ditemukan: ', [
                    'no_spdp' => $no_spdp,
                    'search_type' => is_numeric($no_spdp) ? 'id' : 'no_spdp'
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Data penyidikan tidak ditemukan!'
                ], 404);
            }

            Log::info('Berhasil menemukan catatan penyidikan: ', [
                'id' => $penyidikan->id,
                'no_spdp' => $penyidikan->no_spdp
            ]);

            return response()->json([
                'success' => true,
                'data' => $penyidikan
            ]);
        } catch (Exception $e) {
            Log::error('Kesalahan dalam mengedit data penyidikan: ', [
                'no_spdp' => $no_spdp,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data penyidikan: ' . $e->getMessage(),
                'debug_info' => config('app.debug') ? [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ] : null
            ], 500);
        }
    }

    public function update(Request $request, $no_spdp)
    {
        try {
            DB::beginTransaction();
            Log::info('Mencoba memperbarui Penyidikan dengan No. SPDP: ' . $no_spdp);
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
                Log::error('Catatan penyidikan tidak ditemukan untuk pembaruan dengan No. SPDP: ' . $no_spdp);
                throw new Exception('Data penyidikan tidak ditemukan!');
            }

            Log::info('Menemukan catatan penyidikan untuk diperbarui: ', [
                'id' => $penyidikan->id,
                'no_spdp' => $penyidikan->no_spdp,
                'is_trashed' => $penyidikan->trashed()
            ]);

            $no_spdp_baru = $request->input('no_spdp');
            Log::info('Meminta No. SPDP baru yang diminta: ' . $no_spdp_baru);

            $duplicate_exists = PenyidikanModel::where('no_spdp', $no_spdp_baru)
                ->where('id', '!=', $penyidikan->id)
                ->whereNull('deleted_at')
                ->exists();

            if ($duplicate_exists) throw new Exception('Nomor SPDP sudah digunakan.');

            $validated = $request->validate([
                'no_spdp' => ['required', 'string', 'max:255', 'unique:penyidikan,no_spdp,' . $penyidikan->id],
                'tanggal_spdp' => ['required', 'date'],
                'pelaku' => ['required', 'string', 'max:255'],
                'keterangan' => ['nullable', 'string'],
            ]);

            $validated['updated_by'] = Auth::id();

            if ($penyidikan->trashed()) {
                Log::info('Memulihkan catatan penyidikan yang dibuang...');
                $penyidikan->restore();
            }

            Log::info('Memperbarui catatan penyidikan dengan data baru...');
            $penyidikan->fill($validated);
            $penyidikan->save();

            DB::commit();

            Log::info('Berhasil memperbarui catatan penyidikan!');
            return response()->json([
                'success' => true,
                'message' => 'Data penyidikan berhasil diperbarui!',
                'data' => $penyidikan
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan dalam memperbarui data penyidikan: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data penyidikan: ' . $e->getMessage()
            ], 500);
        }
    }
}