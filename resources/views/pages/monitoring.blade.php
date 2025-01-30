@component('layouts.main', [
    'judul' => 'Monitoring',
    'deskripsi' => '',
])
    <main class="container mx-auto pt-12 pb-6">
        @include('shared.ui.penjelasan', [
            'title' => 'Monitoring',
            'description' => 'Halaman ini digunakan untuk memantau semua data dalam bentuk grafik dan tabel Excel.'
        ])
        @include('components.monitoring.visualisasi-data')
        @include('components.monitoring.menampilkan-data')
    </main>
@endcomponent