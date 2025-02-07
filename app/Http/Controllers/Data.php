<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Intelijen as IntelijenRequest;
use App\Http\Requests\Penindakan as PenindakanRequest;
use App\Http\Requests\Penyidikan as PenyidikanRequest;
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
                $validated = $this->validate_request($request, $entity_type);

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
                        throw new Exception('Tipe entitas tidak valid!');
                }

                return response()->json(['message' => 'Data berhasil disimpan.'], 201);
            });
        } catch (Exception $e) {
            Log::error('Error in storing data: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function validate_request(Request $request, string $entity_type): array
    {
        return match ($entity_type) {
            'intelijen' => $request->validate((new IntelijenRequest())->rules()),
            'penindakan' => $request->validate((new PenindakanRequest())->rules()),
            'penyidikan' => $request->validate((new PenyidikanRequest())->rules()),
            default => throw new Exception('Tipe entitas tidak valid.'),
        };
    }
}