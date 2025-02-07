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
            [
                'no_spdp' => 'SPDP/06/IV/2024/BC.02',
                'tanggal_spdp' => '2024-04-12',
                'pelaku' => 'Alice Cooper',
                'keterangan' => 'Penyelundupan obat terlarang',
                'created_by' => 2,
            ],
            [
                'no_spdp' => 'SPDP/07/IV/2024/BC.02',
                'tanggal_spdp' => '2024-04-20',
                'pelaku' => 'Bruce Wayne',
                'keterangan' => 'Penyelundupan uang palsu',
                'created_by' => 1,
            ],
            [
                'no_spdp' => 'SPDP/08/V/2024/BC.02',
                'tanggal_spdp' => '2024-05-08',
                'pelaku' => 'Clark Kent',
                'keterangan' => 'Penyelundupan dokumen rahasia',
                'created_by' => 3,
            ],
            [
                'no_spdp' => 'SPDP/09/V/2024/BC.02',
                'tanggal_spdp' => '2024-05-15',
                'pelaku' => 'Diana Prince',
                'keterangan' => 'Penyelundupan senjata ilegal',
                'created_by' => 2,
            ],
            [
                'no_spdp' => 'SPDP/10/V/2024/BC.02',
                'tanggal_spdp' => '2024-05-22',
                'pelaku' => 'Barry Allen',
                'keterangan' => 'Penyelundupan logam berat',
                'created_by' => 1,
            ],
            [
                'no_spdp' => 'SPDP/11/V/2024/BC.02',
                'tanggal_spdp' => '2024-05-25',
                'pelaku' => 'Lukas Purnama',
                'keterangan' => 'Penyelundupan dokumen palsu',
                'created_by' => 2,
            ],
            [
                'no_spdp' => 'SPDP/12/VI/2024/BC.02',
                'tanggal_spdp' => '2024-06-05',
                'pelaku' => 'Maya Sari',
                'keterangan' => 'Penyelundupan senjata api ilegal',
                'created_by' => 3,
            ],
            [
                'no_spdp' => 'SPDP/13/VI/2024/BC.02',
                'tanggal_spdp' => '2024-06-12',
                'pelaku' => 'Budi Santoso',
                'keterangan' => 'Penyelundupan barang antik ilegal',
                'created_by' => 1,
            ],
            [
                'no_spdp' => 'SPDP/14/VI/2024/BC.02',
                'tanggal_spdp' => '2024-06-18',
                'pelaku' => 'Rina Wahyuni',
                'keterangan' => 'Penyelundupan barang palsu mewah',
                'created_by' => 2,
            ],
            [
                'no_spdp' => 'SPDP/15/VI/2024/BC.02',
                'tanggal_spdp' => '2024-06-25',
                'pelaku' => 'Agus Salim',
                'keterangan' => 'Penyelundupan alat komunikasi rahasia',
                'created_by' => 3,
            ],
        ];

        foreach ($data as $record) {
            Penyidikan::create($record);
        }
    }
} 