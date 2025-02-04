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
                        $model = new Intelijen();
                        $validated['keterangan'] = $validated['intelijen_keterangan'] ?? null;
                        unset($validated['intelijen_keterangan']);
                        break;
                    case 'penindakan':
                        $model = new PenindakanModel();
                        $penyidikan = PenyidikanModel::findOrFail($validated['penyidikan_id']);
                        $validated['pelaku'] = $penyidikan->pelaku;
                        if ($penyidikan->intelijen) $penyidikan->intelijen->markAsProcessed();
                        break;
                    case 'penyidikan':
                        $model = new PenyidikanModel();
                        $intelijen = IntelijenModel::findOrFail($validated['intelijen_id']);
                        $intelijen->markAsProcessed();

                        if (isset($validated['penyidikan_keterangan'])) {
                            $validated['keterangan'] = $validated['penyidikan_keterangan'];
                            unset($validated['penyidikan_keterangan']);
                        }
                        break;
                    default:
                        throw new Exception('Invalid entity type');
                }

                $model->fill($validated);
                $model->created_by = Auth::id();
                $model->save();

                return redirect()
                    ->route($entity_type)
                    ->with('success', 'Data berhasil disimpan');
            });
        } catch (Exception $e) {
            Log::error('Error saving data:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    private function validate_data(Request $request, string $entity_type): array
    {
        $rules = $this->get_validation_rules($entity_type);
        return $request->validate($rules);
    }

    private function get_validation_rules(string $entity_type): array
    {
        $base_rules = [
            'entity_type' => ['required', 'string', 'in:intelijen,penindakan,penyidikan'],
        ];

        $type_rules = [];
        switch ($entity_type) {
            case 'intelijen':
                $type_rules = [
                    'no_nhi' => ['required', 'string', 'unique:intelijen,no_nhi,NULL,id,deleted_at,NULL'],
                    'tanggal_nhi' => ['required', 'date'],
                    'tempat' => ['required', 'string'],
                    'jenis_barang' => ['required', 'string'],
                    'jumlah_barang' => ['required', 'integer', 'min:1'],
                    'intelijen_keterangan' => ['nullable', 'string'],
                ];
                break;
            case 'penyidikan':
                $type_rules = [
                    'intelijen_id' => ['required', 'exists:intelijen,id'],
                    'no_spdp' => ['required', 'string', 'unique:penyidikan,no_spdp,NULL,id,deleted_at,NULL'],
                    'tanggal_spdp' => ['required', 'date'],
                    'pelaku' => ['required', 'string'],
                    'penyidikan_keterangan' => ['nullable', 'string'],
                ];
                break;
            case 'penindakan':
                $type_rules = [
                    'penyidikan_id' => ['required', 'exists:penyidikan,id'],
                    'no_sbp' => ['required', 'string', 'unique:penindakan,no_sbp,NULL,id,deleted_at,NULL'],
                    'tanggal_sbp' => ['required', 'date'],
                    'lokasi_penindakan' => ['required', 'string'],
                    'uraian_bhp' => ['required', 'string'],
                    'jumlah' => ['required', 'integer', 'min:1'],
                    'kemasan' => ['nullable', 'string'],
                    'perkiraan_nilai_barang' => ['required', 'integer', 'min:0'],
                    'potensi_kurang_bayar' => ['required', 'integer', 'min:0'],
                ];
                break;
        }
        return array_merge($base_rules, $type_rules);
    }
}