@extends('layouts.main')

@section('judul')
    Reset Kata Sandi
@endsection

@section('deskripsi')
    Waduh, lupa kata sandi? Jangan panik, kami bantu ingetin kok. Cuma perlu NIP aja!
@endsection

@section('konten')
    @include('components.autentikasi.lupa-kata-sandi')
@endsection