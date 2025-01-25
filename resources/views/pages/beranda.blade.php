@component('layouts.main', [
    'judul' => 'Beranda',
    'deskripsi' => '',
])
    <main class="container mx-auto px-4 pt-2 pb-6">
        @include('components.beranda.selamat-datang')
        @include('components.beranda.informasi-akun')
        @include('components.beranda.menu')
    </main>
@endcomponent