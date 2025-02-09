@extends('layouts.main')

@section('judul')
    Intelijen
@endsection

@section('deskripsi')
    Kelola dan pantau kegiatan intelijen Bea Cukai Blitar dengan mudah. Mulai dari pengumpulan informasi hingga analisis
    data pengawasan, semua ada di sini.
@endsection

@section('active_tab')
    intelijen
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6">
        @include('shared.navigation.back')
        @include('components.intelijen.main')
    </main>
@endsection