@component('layouts.main', [
    'judul' => 'Dokumen Intelijen',
    'deskripsi' => '',
])
<main class="container mx-auto pt-12 pb-6">
    @include('components.intelijen.dokumen', ['documents' => $documents, 'no_nhi' => $no_nhi])
</main>
@endcomponent
