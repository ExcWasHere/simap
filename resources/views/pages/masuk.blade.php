@extends('layouts.main')

@section('judul')
    Masuk
@endsection

@section('deskripsi')
    Masuk ke SIMAP untuk akses aman ke sistem pengelolaan data Bea Cukai Blitar. Jangan lupa buat isi NIP dan kata sandi!
@endsection

@section('konten')
    @include('components.autentikasi.masuk')
@endsection