@component('layouts.main', [
    'judul' => 'Dokumen Penindakan',
    'deskripsi' => '',
])
<main class="container mx-auto pt-12 pb-6">
    @include('components.penindakan.dokumen', ['documents' => $documents, 'no_sbp' => $no_sbp])
</main>
@endcomponent
