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
    @include('shared.navigation.back')
    @include('components.intelijen.main')
@endsection