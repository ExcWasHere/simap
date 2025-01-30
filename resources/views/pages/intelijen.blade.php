@component('layouts.main', [
    'judul' => 'Intelijen',
    'deskripsi' => '',
    'activeTab' => 'intelijen'
])
    <main class="container mx-auto pt-12 pb-6">
        @include('components.intelijen.main')
    </main>
@endcomponent