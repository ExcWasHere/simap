@component('layouts.main', [
    'judul' => 'Monitoring BHP',
    'deskripsi' => '',
])
    <main class="container mx-auto px-4 pt-2 pb-6">
    @include('shared.ui.penjelasan', [
    'title' => 'Monitoring',
    'description' => 'Halaman ini digunakan untuk memantau semua data dalam bentuk grafik dan tabel Excel.'
])
    @include('components.monitoring-bhp.visualisasi-data')
    @include('components.monitoring-bhp.menampilkan-data')
    </main>
@endcomponent