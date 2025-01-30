<?php

namespace App\Http\Controllers;

use App\Models\Intelijen;
use App\Models\Penindakan;
use App\Models\Penyidikan;
use DB;
use Illuminate\Http\Request;

class DataController
{
    public function store(Request $request)
    {
        $entityType = $request->input('entity_type');

        try {
            return DB::transaction(function () use ($request, $entityType) {
                $validated = $this->validateData($request, $entityType);

                switch ($entityType) {
                    case 'intelijen':
                        $model = new Intelijen();
                        $validated['keterangan'] = $validated['intelijen_keterangan'] ?? null;
                        unset($validated['intelijen_keterangan']);
                        break;
                    case 'penindakan':
                        $model = new Penindakan();
                        $penyidikan = Penyidikan::findOrFail($validated['penyidikan_id']);
                        $validated['pelaku'] = $penyidikan->pelaku;

                        if ($penyidikan->intelijen) {
                            $penyidikan->intelijen->markAsProcessed();
                        }
                        break;
                    case 'penyidikan':
                        $model = new Penyidikan();
                        $intelijen = Intelijen::findOrFail($validated['intelijen_id']);
                        
                        $intelijen->markAsProcessed();

                        if (isset($validated['penyidikan_keterangan'])) {
                            $validated['keterangan'] = $validated['penyidikan_keterangan'];
                            unset($validated['penyidikan_keterangan']);
                        }
                        break;
                    default:
                        throw new \Exception('Invalid entity type');
                }

                $model->fill($validated);
                $model->created_by = auth()->id();
                $model->save();

                return redirect()
                    ->route($entityType)
                    ->with('success', 'Data berhasil disimpan');
            });
        } catch (\Exception $e) {
            \Log::error('Error saving data:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    private function validateData(Request $request, string $entityType): array
    {
        $rules = $this->getValidationRules($entityType);
        return $request->validate($rules);
    }

    private function getValidationRules(string $entityType): array
    {
        $baseRules = [
            'entity_type' => ['required', 'string', 'in:intelijen,penindakan,penyidikan'],
        ];

        $typeRules = [];
        switch ($entityType) {
            case 'intelijen':
                $typeRules = [
                    'no_nhi' => ['required', 'string', 'unique:intelijen,no_nhi'],
                    'tanggal_nhi' => ['required', 'date'],
                    'tempat' => ['required', 'string'],
                    'jenis_barang' => ['required', 'string'],
                    'jumlah_barang' => ['required', 'integer', 'min:1'],
                    'intelijen_keterangan' => ['nullable', 'string'],
                ];
                break;
            case 'penyidikan':
                $typeRules = [
                    'intelijen_id' => ['required', 'exists:intelijen,id'],
                    'no_spdp' => ['required', 'string', 'unique:penyidikan,no_spdp'],
                    'tanggal_spdp' => ['required', 'date'],
                    'pelaku' => ['required', 'string'],
                    'penyidikan_keterangan' => ['nullable', 'string'],
                ];
                break;
            case 'penindakan':
                $typeRules = [
                    'penyidikan_id' => ['required', 'exists:penyidikan,id'],
                    'no_sbp' => ['required', 'string', 'unique:penindakan,no_sbp'],
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

        return array_merge($baseRules, $typeRules);
    }

    private function determineActiveTab(array $errors): string
    {
        if (array_key_exists('penindakan_id', $errors) || isset($errors['penyidikan'])) {
            return 'penyidikan';
        }

        if (array_key_exists('no_nhi', $errors) || isset($errors['intelijen'])) {
            return 'intelijen';
        }

        return 'penindakan';
    }
}
