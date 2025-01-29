<?php

namespace App\Http\Controllers;

use App\Models\Penyidikan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenyidikanController
{
    public function index(Request $request): View
    {
        $query = Penyidikan::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('no_spdp', 'like', "%{$search}%")
                    ->orWhere('pelaku', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->whereDate('tanggal_spdp', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->whereDate('tanggal_spdp', '<=', $dateTo);
        }

        $penyidikan = $query->latest()->paginate(10)->withQueryString();

        $rows = $penyidikan->map(function ($item, $index) use ($penyidikan) {
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
        ]);
    }
}
