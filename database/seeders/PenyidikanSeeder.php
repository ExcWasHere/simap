<?php

namespace Database\Seeders;

use App\Models\Penyidikan;
use Illuminate\Database\Seeder;

class PenyidikanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'no_spdp' => 'SPDP/01/I/2024/BC.02',
                'tanggal_spdp' => '2024-01-15',
                'pelaku' => 'John Doe',
                'keterangan' => 'Penyelundupan rokok ilegal',
                'created_by' => 1,
            ],
            [
                'no_spdp' => 'SPDP/02/II/2024/BC.02',
                'tanggal_spdp' => '2024-02-20',
                'pelaku' => 'Jane Smith',
                'keterangan' => 'Penyelundupan minuman keras',
                'created_by' => 1,
            ],
            [
                'no_spdp' => 'SPDP/03/III/2024/BC.02',
                'tanggal_spdp' => '2024-03-10',
                'pelaku' => 'Robert Johnson',
                'keterangan' => 'Penyelundupan narkotika',
                'created_by' => 1,
            ],
            [
                'no_spdp' => 'SPDP/04/III/2024/BC.02',
                'tanggal_spdp' => '2024-03-18',
                'pelaku' => 'David Chen',
                'keterangan' => 'Penyelundupan rokok elektrik ilegal',
                'created_by' => 2,
            ],
            [
                'no_spdp' => 'SPDP/05/III/2024/BC.02',
                'tanggal_spdp' => '2024-03-20',
                'pelaku' => 'James Wilson',
                'keterangan' => 'Penyelundupan minuman keras tanpa cukai',
                'created_by' => 3,
            ],
        ];

        foreach ($data as $record) {
            Penyidikan::create($record);
        }
    }
} 