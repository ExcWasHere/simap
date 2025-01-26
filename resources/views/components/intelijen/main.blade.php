<main class="container mx-auto px-4 py-6">
    @include('shared.navigation.content-header', ['title' => 'Data Intelijen'])
    @include('shared.navigation.search', ['placeholder' => 'Cari data intelijen...'])
    @include('shared.tables.table', [
        'headers' => ['No', 'No NHI', 'Tgl NHI', 'Tempat', 'Jenis', 'Jumlah Barang', 'Keterangan'],
        'rows' => [
            [
                '1',
                '123456',
                '22-09-2024',
                'DSN DOKO RT 01 RW 01, KALIANYAR, KEC. KALIANYAR, KAB. BLITAR',
                'ROKOK SMTH ILEGAL',
                '20 (DUA PULUH) BAL',
                '-',
            ],
        ],
    ])
    @include('shared.navigation.pagination')
</main>