@component('layouts.main', [
    'judul' => 'Dokumen Penyidikan',
    'deskripsi' => '',
])
<main class="container mx-auto pt-12 pb-6">
    @include('components.penyidikan.dokumen')
</main>
@endcomponent