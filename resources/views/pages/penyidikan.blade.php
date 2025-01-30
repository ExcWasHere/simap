@component('layouts.main', [
    'judul' => 'Penyidikan',
    'deskripsi' => '',
    'activeTab' => 'penyidikan'
])
    <main class="container mx-auto pt-12 pb-6">
        @include('components.penyidikan.main')
    </main>
@endcomponent
