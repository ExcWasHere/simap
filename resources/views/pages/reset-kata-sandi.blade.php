@extends('layouts.main')

@section('judul')
    Reset Kata Sandi
@endsection

@section('deskripsi')
    Silakan buat kata sandi baru supaya bisa kembali ke SIMAP dengan aman. Pastikan nggak lupa lagi ya!
@endsection

@section('konten')
    @include('components.autentikasi.reset-kata-sandi')
@endsection