<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intelijen as IntelijenModel;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class Intelijen extends Controller
{
    /**
     * Views
     */
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

        if ($date_from = $request->input('date_from')) $query->whereDate('tanggal_nhi', '>=', $date_from);
        if ($date_to = $request->input('date_to')) $query->whereDate('tanggal_nhi', '<=', $date_to);

        $sort = $request->input('sort', 'abjad');
        if ($sort === 'abjad') {
            $query->orderBy('no_nhi', 'asc');
        } else if ($sort === 'latest') {
            $query->latest(); 
        }

        $perPage = $request->input('per_page', 5);
        $intelijen = $query->orderBy('no_nhi')->paginate($perPage)->appends($request->query());

        $rows = collect($intelijen->items())->map(function ($item, $index) use ($intelijen) {
            return [
                ($intelijen->currentPage() - 1) * $intelijen->perPage() + $index + 1,
                $item->no_nhi,
                $item->tanggal_nhi->format('d-m-Y'),
                $item->tempat,
                $item->jenis_barang,
                $item->jumlah_barang,
                $item->kemasan,
                $item->keterangan,
            ];
        })->toArray();

        return view('pages.intelijen', [
            'rows' => $rows,
            'intelijen' => $intelijen
        ]);
    }

    public function show(Request $request)
    {
        $query = IntelijenModel::query();
        
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('no_nhi', 'like', "%{$search}%")
                  ->orWhere('tempat', 'like', "%{$search}%")
                  ->orWhere('jenis_barang', 'like', "%{$search}%");
            });
        }
    
        if ($date_from = $request->input('date_from')) {
            $query->whereDate('tanggal_nhi', '>=', $date_from);
        }
        if ($date_to = $request->input('date_to')) {
            $query->whereDate('tanggal_nhi', '<=', $date_to);
        }
    
        $sort = $request->input('sort', 'abjad');
        if ($sort === 'abjad') {
            $query->orderBy('no_nhi', 'asc');
        } else if ($sort === 'latest') {
            $query->latest(); 
        }
    
        $perPage = $request->input('per_page', 5);
        $intelijen = $query->paginate($perPage)->appends($request->query());
    
        $rows = collect($intelijen->items())->map(function ($item, $index) use ($intelijen) {
            return [
                ($intelijen->currentPage() - 1) * $intelijen->perPage() + $index + 1,
                $item->no_nhi,
                $item->tanggal_nhi->format('d-m-Y'),
                $item->tempat,
                $item->jenis_barang,
                $item->jumlah_barang,
                $item->kemasan,
                $item->keterangan,
            ];
        })->toArray();
    
        return view('pages.intelijen', [
            'rows' => $rows,
            'intelijen' => $intelijen
        ]);
    }

    /**
     * Controllers
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'no_nhi' => ['required', 'string', 'max:255', 'unique:intelijen,no_nhi'],
                'tanggal_nhi' => ['required', 'date'],
                'tempat' => ['required', 'string', 'max:255'],
                'jenis_barang' => ['required', 'string', 'max:255'],
                'jumlah_barang' => ['required', 'integer', 'min:1'],
                'kemasan' => ['nullable', 'string', 'in:liter,batang'],
                'intelijen_keterangan' => ['nullable', 'string'],
            ]);

            $validated['keterangan'] = $validated['intelijen_keterangan'] ?? null;
            unset($validated['intelijen_keterangan']);
            $validated['created_by'] = Auth::id();

            IntelijenModel::create($validated);
            DB::commit();

            return redirect()
                ->route('intelijen')
                ->with('success', 'Data intelijen berhasil disimpan!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan dalam menyimpan data intelijen: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan data intelijen: ' . $e->getMessage()]);
        }
    }

    public function destroy($no_nhi)
    {
        try {
            DB::beginTransaction();
            Log::info('Mencoba menghapus catatan intelijen dengan No. NHI: ' . $no_nhi);

            $intelijen = IntelijenModel::whereNull('deleted_at')
                ->where('no_nhi', $no_nhi)
                ->firstOrFail();

            $timestamp = now()->format('YmdHis');
            $random = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $suffix = "_deleted_{$timestamp}{$random}";

            $intelijen->no_nhi = $intelijen->no_nhi . $suffix;
            $intelijen->save();
            $intelijen->delete();

            Log::info('Berhasil menghapus catatan intelijen!');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data intelijen berhasil dihapus!'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan dalam menghapus data intelijen: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data intelijen: ' . $e->getMessage()
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
                'kemasan' => ['nullable', 'string', 'in:liter,batang'],
                'keterangan' => ['nullable', 'string'],
            ]);

            $validated['updated_by'] = Auth::id();
            $intelijen->update($validated);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data intelijen berhasil diperbarui!',
                'data' => $intelijen
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Kesalahan dalam memperbarui data intelijen: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data intelijen: ' . $e->getMessage()
            ], 500);
        }
    }
}