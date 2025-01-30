@component('layouts.main', [
    'judul' => 'Dokumen Monitoring',
    'deskripsi' => '',
])
<main class="container mx-auto pt-12 pb-6">
    @include('components.monitoring.dokumen', ['documents' => $documents, 'id' => $id])
</main>
@endcomponent
