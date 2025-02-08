@extends('layouts.main')

@section('judul')
    Monitoring
@endsection

@section('deskripsi')
    Grafik buat yang suka visual, tabel Excel buat yang suka angka. Apa pun gayamu, semua data bisa dipantau di sini!
@endsection

@section('konten')
    @include('shared.navigation.back')
    @include('shared.ui.penjelasan', [
        'title' => 'Monitoring',
        'description' => 'Halaman ini digunakan untuk memantau semua data dalam bentuk grafik dan tabel Excel.',
    ])
    @include('components.monitoring.visualisasi-data')
    @include('components.monitoring.menampilkan-data')
@endsection