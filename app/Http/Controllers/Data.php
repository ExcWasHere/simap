<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intelijen as IntelijenModel;
use App\Models\Penindakan as PenindakanModel;
use App\Models\Penyidikan as PenyidikanModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class Data extends Controller
{
    /**
     * Views
     */
    public function intelijen(): View
    {
        return view('pages.tambah-data-intelijen');
    }

    public function penindakan(): View
    {
        return view('pages.tambah-data-penindakan');
    }

    public function penyidikan(): View
    {
        return view('pages.tambah-data-penyidikan');
    }

    /**
     * Controllers
     */
    public function store(Request $request)
    {
        $entity_type = $request->input('entity_type');

        try {
            return DB::transaction(function () use ($request, $entity_type) {
                $validated = $this->validate_data($request, $entity_type);

                switch ($entity_type) {
                    case 'intelijen':
                        $validated['keterangan'] = $validated['intelijen_keterangan'] ?? null;
                        unset($validated['intelijen_keterangan']);
                        $validated['created_by'] = Auth::id();
                        IntelijenModel::create($validated);
                        break;

                    case 'penyidikan':
                        $validated['created_by'] = Auth::id();
                        PenyidikanModel::create($validated);
                        break;

                    case 'penindakan':
                        $validated['created_by'] = Auth::id();
                        PenindakanModel::create($validated);
                        break;

                    default:
                        throw new Exception('Tipe entitas tidak valid');
                }

                return response()->json(['message' => 'Data berhasil disimpan'], 201);
            });
        } catch (Exception $e) {
            Log::error('Error in storing data: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function validate_data(Request $request, string $entity_type): array
    {
        return match ($entity_type) {
            'intelijen' => $request->validate([
                'no_nhi' => ['required', 'string', 'max:255', 'unique:intelijen,no_nhi'],
                'tanggal_nhi' => ['required', 'date'],
                'tempat' => ['required', 'string', 'max:255'],
                'jenis_barang' => ['required', 'string', 'max:255'],
                'jumlah_barang' => ['required', 'integer', 'min:1'],
                'kemasan' => ['nullable', 'string', 'in:liter,batang'],
                'intelijen_keterangan' => ['nullable', 'string'],
            ]),
            'penyidikan' => $request->validate([
                'no_spdp' => ['required', 'string', 'max:255', 'unique:penyidikan,no_spdp'],
                'tanggal_spdp' => ['required', 'date'],
                'pelaku' => ['required', 'string', 'max:255'],
                'penyidikan_keterangan' => ['nullable', 'string'],
            ]),
            'penindakan' => $request->validate([
                'no_sbp' => ['required', 'string', 'max:255', 'unique:penindakan,no_sbp'],
                'tanggal_sbp' => ['required', 'date'],
                'lokasi_penindakan' => ['required', 'string'],
                'pelaku' => ['required', 'string', 'max:255'],
                'uraian_bhp' => ['required', 'string'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'perkiraan_nilai_barang' => ['required', 'numeric', 'min:0'],
                'potensi_kurang_bayar' => ['required', 'numeric', 'min:0'],
            ]),
            default => throw new Exception('Tipe entitas tidak valid'),
        };
    }
}