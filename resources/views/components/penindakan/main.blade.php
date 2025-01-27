<main class="container mx-auto px-4 py-6">
    @include('shared.ui.penjelasan', [
        'title' => 'Penindakan',
        'description' => 'Halaman ini digunakan untuk mengelola data penindakan terhadap pelanggaran, termasuk pencatatan barang hasil penindakan dan proses hukum.'
    ])
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
        'rows' => $rows
    ])
    {{ $penindakan->links() }}
</main>