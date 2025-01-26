@component('layouts.main', [
    'judul' => 'Monitoring BHP',
    'deskripsi' => '',
])
    <main class="container mx-auto px-4 pt-2 pb-6">
        @include('components.monitoring-bhp.penjelasan')
        @include('components.monitoring-bhp.visualisasi-data')
        @include('components.monitoring-bhp.menampilkan-data')
    </main>
@endcomponent