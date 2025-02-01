<main class="container mx-auto">
    @include('shared.ui.penjelasan', [
        'title' => 'Penindakan',
        'description' => 'Halaman ini digunakan untuk mengelola data penindakan terhadap pelanggaran, termasuk pencatatan barang hasil penindakan dan proses hukum.'
    ])
    @include('shared.navigation.search', [
        'placeholder' => 'Cari data penindakan...',
        'section' => 'penindakan'
    ])
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
        'rows' => $rows,
        'moduleIds' => $moduleIds
    ])
    {{ $penindakan->links() }}
    
    @include('shared.modals.modal-edit', ['section' => 'penindakan'])
</main>