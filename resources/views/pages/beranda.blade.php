@extends('layouts.main')

@section('judul')
    Beranda
@endsection

@section('deskripsi')
    Selamat datang di SIMAP (Sistem Informasi Manajemen Intelijen dan Pengawasan). Aplikasi ini membantu untuk mengelola,
    menyimpan, dan mengakses data Bea Cukai Blitar secara digital dengan aman.
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6">
        @include('components.beranda.selamat-datang')
        @include('components.beranda.informasi-akun')
        @include('components.beranda.menu')
    </main>
@endsection