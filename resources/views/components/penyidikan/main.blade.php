<main class="container mx-auto">
    @include('shared.ui.penjelasan', [
        'title' => 'Penyidikan',
        'description' => 'Halaman ini digunakan untuk mengelola proses penyidikan kasus, termasuk dokumentasi bukti dan perkembangan kasus hukum.'
    ])
    @include('shared.navigation.search', ['placeholder' => 'Cari data penyidikan...'])
    @include('shared.tables.table', [
        'headers' => ['No', 'No SPDP', 'Tgl SPDP', 'Pelaku', 'Keterangan'],
        'rows' => $rows
    ])
    {{ $penyidikan->links() }}
</main>