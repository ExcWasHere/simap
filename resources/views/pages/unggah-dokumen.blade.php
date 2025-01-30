@component('layouts.main', [
    'judul' => 'Upload Dokumen',
    'deskripsi' => '',
])
    <main class="container mx-auto pt-12 pb-6">
        @include('components.unggah-dokumen.main')
    </main>
@endcomponent