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
    @include('shared.navigation.back')
    @include('components.penindakan.main')
@endsection