<?php

namespace App\Http\Controllers;

use App\Models\Intelijen;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IntelijenController
{
    public function index(Request $request): View
    {
        $query = Intelijen::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('no_nhi', 'like', "%{$search}%")
                  ->orWhere('tempat', 'like', "%{$search}%")
                  ->orWhere('jenis_barang', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->whereDate('tanggal_nhi', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->whereDate('tanggal_nhi', '<=', $dateTo);
        }

        $intelijen = $query->latest()->paginate(10)->withQueryString();

        $rows = $intelijen->map(function ($item, $index) use ($intelijen) {
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
        ]);
    }
}
