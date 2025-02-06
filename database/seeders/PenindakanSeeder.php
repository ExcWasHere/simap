<?php

namespace Database\Seeders;

use App\Models\Penindakan;
use Illuminate\Database\Seeder;

class PenindakanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'no_sbp' => 'SBP/01/I/2024/BC.02',
                'tanggal_sbp' => '2024-01-20',
                'lokasi_penindakan' => 'Pelabuhan Tanjung Priok',
                'pelaku' => 'Alex Wilson',
                'uraian_bhp' => 'Rokok ilegal',
                'jumlah' => 1000,
                'kemasan' => 'batang',
                'perkiraan_nilai_barang' => 50000000,
                'potensi_kurang_bayar' => 25000000,
                'status' => 'open',
                'created_by' => 1,
            ],
            [
                'no_sbp' => 'SBP/02/II/2024/BC.02',
                'tanggal_sbp' => '2024-02-25',
                'lokasi_penindakan' => 'Bandara Soekarno-Hatta',
                'pelaku' => 'Sarah Brown',
                'uraian_bhp' => 'Minuman keras',
                'jumlah' => 100,
                'kemasan' => 'liter',
                'perkiraan_nilai_barang' => 75000000,
                'potensi_kurang_bayar' => 35000000,
                'status' => 'processed',
                'created_by' => 1,
            ],
            [
                'no_sbp' => 'SBP/03/III/2024/BC.02',
                'tanggal_sbp' => '2024-03-15',
                'lokasi_penindakan' => 'Pelabuhan Merak',
                'pelaku' => 'Michael Davis',
                'uraian_bhp' => 'Narkotika',
                'jumlah' => 50,
                'kemasan' => 'liter',
                'perkiraan_nilai_barang' => 100000000,
                'potensi_kurang_bayar' => 50000000,
                'status' => 'closed',
                'created_by' => 1,
            ],
            [
                'no_sbp' => 'SBP/04/III/2024/BC.02',
                'tanggal_sbp' => '2024-03-18',
                'lokasi_penindakan' => 'Bandara Juanda',
                'pelaku' => 'David Chen',
                'uraian_bhp' => 'Rokok Elektrik',
                'jumlah' => 800,
                'kemasan' => 'batang',
                'perkiraan_nilai_barang' => 40000000,
                'potensi_kurang_bayar' => 20000000,
                'status' => 'open',
                'created_by' => 2,
            ],
            [
                'no_sbp' => 'SBP/05/III/2024/BC.02',
                'tanggal_sbp' => '2024-03-20',
                'lokasi_penindakan' => 'Pelabuhan Tanjung Perak',
                'pelaku' => 'James Wilson',
                'uraian_bhp' => 'Minuman keras impor',
                'jumlah' => 250,
                'kemasan' => 'liter',
                'perkiraan_nilai_barang' => 125000000,
                'potensi_kurang_bayar' => 60000000,
                'status' => 'processed',
                'created_by' => 3,
            ],
        ];

        foreach ($data as $record) {
            Penindakan::create($record);
        }
    }
} 