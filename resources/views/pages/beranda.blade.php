@extends('layouts.main')

@section('judul')
    Beranda
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('components.beranda.selamat-datang')
        @include('components.beranda.informasi-akun')
        @include('components.beranda.menu')
    </div>
@endsection