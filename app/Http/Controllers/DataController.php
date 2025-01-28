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
            DB::transaction(function () use ($request, $entityType) {
                $validated = $this->validateData($request, $entityType);
                
                $model = match ($entityType) {
                    'penindakan' => new Penindakan(),
                    'penyidikan' => new Penyidikan(),
                    'intelijen' => new Intelijen(),
                    default => throw new \InvalidArgumentException('Invalid entity type')
                };

                $model->fill($validated);
                $model->created_by = auth()->id();
                $model->save();

                // For Penyidikan, handle the relationship with Penindakan
                if ($entityType === 'penyidikan' && isset($validated['penindakan_id'])) {
                    $model->penindakan()->associate($validated['penindakan_id']);
                    $model->save();
                }
            });

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error saving data:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    private function validateData(Request $request, string $entityType)
    {
        $validated = $request->validate($this->validationRules($entityType));
        
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        return $validated;
    }

    private function validationRules(string $entityType): array
    {
        $baseRules = [
            'entity_type' => 'required|in:penindakan,penyidikan,intelijen'
        ];

        $typeRules = match($entityType) {
            'penindakan' => [
                'no_sbp' => 'required|string|max:255|unique:penindakan',
                'tanggal_sbp' => 'required|date',
                'lokasi_penindakan' => 'required|string|max:255',
                'pelaku' => 'required|string|max:255',
                'uraian_bhp' => 'required|string|max:255',
                'jumlah' => 'required|integer|min:1',
                'perkiraan_nilai_barang' => 'required|numeric|min:0',
                'potensi_kurang_bayar' => 'required|numeric|min:0',
            ],
            'penyidikan' => [
                'no_spdp' => 'required|string|max:255|unique:penyidikan',
                'tanggal_spdp' => 'required|date',
                'pelaku' => 'required|string|max:255',
                'keterangan' => 'nullable|string',
                'penindakan_id' => 'required|exists:penindakan,id'
            ],
            'intelijen' => [
                'no_nhi' => 'required|digits:15',
                'tanggal_nhi' => 'required|date',
                'tempat' => 'required|string|max:255',
                'jenis_barang' => 'required|string|max:255',
                'jumlah_barang' => 'required|integer|min:1',
                'keterangan' => 'nullable|string',
            ],
            default => [],
        };

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
