@extends('layouts.main')

@section('judul')
    Penindakan
@endsection

@section('deskripsi')
    Halaman ini khusus buat aksi tegas Bea Cukai! Dari catat barang sitaan sampai urusan proses hukum, semua tercatat rapi
    di sini.
@endsection

@section('active_tab')
    penindakan
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6">
        @include('shared.navigation.back')
        @include('components.penindakan.main')
    </main>
@endsection