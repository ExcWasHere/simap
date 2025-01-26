<div class="container mx-auto px-4 py-6">
    @include('shared.navigation.content-header', ['title' => 'Data Penindakan'])
    @include('shared.navigation.search', ['placeholder' => 'Cari data penindakan...'])
    @include('shared.tables.table', [
        'headers' => [
            'No',
            'No SBP',
            'Tgl SBP',
            'Lokasi Penindakan',
            'Pelaku',
            'Uraian BHP',
            'Jmlh',
            'Perkiraan Nilai Barang',
            'Potensi Kurang Bayar',
        ],
        'rows' => [
            [
                '1',
                '123456',
                '22-09-2024',
                'DSN DOKO RT 01 RW 01, KALIANYAR, KEC. KALIANYAR, KAB. BLITAR',
                'AGUS RIMBA',
                'ROKOK SMTH ILEGAL',
                '20 (DUA PULUH) BAL',
                '10.000.000 (SEPULUH JUTA RUPIAH)',
                '-',
            ],
        ],
    ])
    @include('shared.navigation.pagination')
</div>