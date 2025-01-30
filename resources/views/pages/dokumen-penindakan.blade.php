@component('layouts.main', [
    'judul' => 'Dokumen Penindakan',
    'deskripsi' => '',
])
<main class="container mx-auto pt-12 pb-6">
    @include('components.penindakan.dokumen')
</main>
@endcomponent
