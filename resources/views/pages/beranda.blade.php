@extends('layouts.main')

@section('judul')
    Beranda
@endsection

@section('deskripsi')
    Selamat datang di SIMAP (Sistem Informasi Manajemen Intelijen dan Pengawasan). Aplikasi ini membantu untuk mengelola,
    menyimpan, dan mengakses data Bea Cukai Blitar secara digital dengan aman.
@endsection

@section('konten')
    @include('components.beranda.selamat-datang')
    @include('components.beranda.informasi-akun')
    @include('components.beranda.menu')
@endsection