@component('layouts.main', [
    'judul' => 'Penindakan',
    'deskripsi' => '',
    'activeTab' => 'penindakan'
])
    <main class="container mx-auto pt-12 pb-6">
        @include('components.penindakan.main')
    </main>
@endcomponent