@component('layouts.main', [
    'judul' => 'Grafik Monitoring',
    'deskripsi' => '',
])
    <main class="container mx-auto pt-12 pb-6">
        @include('components.monitoring.chart-display')
    </main>
@endcomponent