<div class="container mx-auto px-4 py-6">
    @include('shared.navigation.content-header', ['title' => 'Data Penyidikan'])

    @include('shared.navigation.search', ['placeholder' => 'Cari data penyidikan...'])

    @include('shared.tables.table', [
    'headers' => [
        'No',
        'No SPDP',
        'Tgl SPDP',
        'Pelaku',
        'Keterangan'
    ],
    'rows' => [
        [
            '1',
            '123456',
            '22-09-2024',
            'AGUS RIMBA',
            '-',
        ]
    ]
])

    @include('shared.navigation.pagination')
</div>


