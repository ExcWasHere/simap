<?php

namespace Database\Seeders;

use App\Models\Intelijen;
use Illuminate\Database\Seeder;

class IntelijenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'no_nhi' => 'NHI/01/I/2024/BC.02',
                'tanggal_nhi' => '2024-01-10',
                'tempat' => 'Gudang A Pelabuhan Tanjung Priok',
                'jenis_barang' => 'Rokok',
                'jumlah_barang' => 5000,
                'kemasan' => 'batang',
                'keterangan' => 'Dugaan penyelundupan rokok ilegal',
                'status' => 'open',
                'created_by' => 1,
            ],
            [
                'no_nhi' => 'NHI/02/II/2024/BC.02',
                'tanggal_nhi' => '2024-02-15',
                'tempat' => 'Terminal 3 Bandara Soekarno-Hatta',
                'jenis_barang' => 'Minuman Keras',
                'jumlah_barang' => 200,
                'kemasan' => 'liter',
                'keterangan' => 'Dugaan penyelundupan minuman keras',
                'status' => 'processed',
                'created_by' => 1,
            ],
            [
                'no_nhi' => 'NHI/03/III/2024/BC.02',
                'tanggal_nhi' => '2024-03-05',
                'tempat' => 'Pelabuhan Merak',
                'jenis_barang' => 'Narkotika',
                'jumlah_barang' => 100,
                'kemasan' => 'liter',
                'keterangan' => 'Dugaan penyelundupan narkotika',
                'status' => 'closed',
                'created_by' => 1,
            ],
            [
                'no_nhi' => 'NHI/04/III/2024/BC.02',
                'tanggal_nhi' => '2024-03-12',
                'tempat' => 'Bandara Juanda Surabaya',
                'jenis_barang' => 'Rokok Elektrik',
                'jumlah_barang' => 1500,
                'kemasan' => 'batang',
                'keterangan' => 'Dugaan penyelundupan vape ilegal',
                'status' => 'open',
                'created_by' => 2,
            ],
            [
                'no_nhi' => 'NHI/05/III/2024/BC.02',
                'tanggal_nhi' => '2024-03-18',
                'tempat' => 'Pelabuhan Tanjung Perak',
                'jenis_barang' => 'Minuman Keras',
                'jumlah_barang' => 350,
                'kemasan' => 'liter',
                'keterangan' => 'Dugaan penyelundupan alkohol tanpa cukai',
                'status' => 'processed',
                'created_by' => 3,
            ],
        ];

        foreach ($data as $record) {
            Intelijen::create($record);
        }
    }
} 