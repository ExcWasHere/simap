<main class="container mx-auto">
    @include('shared.ui.penjelasan', [
        'title' => 'Intelijen',
        'description' => 'Halaman ini digunakan untuk mengelola dan memantau kegiatan intelijen, termasuk pengumpulan informasi dan analisis data pengawasan.'
    ])
    @include('shared.navigation.search', [
        'placeholder' => 'Cari data intelijen...',
        'section' => 'intelijen'
    ])
    @include('shared.tables.table', [
        'headers' => ['No', 'No NHI', 'Tgl NHI', 'Tempat', 'Jenis', 'Jumlah Barang', 'Keterangan'],
        'rows' => $rows,
        'id_modul' => $id_modul
    ])
    {{ $intelijen->links() }}

    @include('shared.modals.modal-edit', ['section' => 'intelijen'])
</main>