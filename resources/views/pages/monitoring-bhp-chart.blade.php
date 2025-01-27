@component('layouts.main', [
    'judul' => 'Grafik Monitoring BHP',
    'deskripsi' => '',
])
    <main class="container mx-auto pt-12 pb-6">
        @include('components.monitoring-bhp.chart-display')
    </main>
@endcomponent