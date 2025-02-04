@extends('layouts.main')

@section('judul')
    Monitoring
@endsection

@section('deskripsi')
@endsection

@section('konten')
    @include('shared.navigation.back')
    <div class="container mx-auto py-6">
        @include('shared.ui.penjelasan', [
            'title' => 'Monitoring',
            'description' => 'Halaman ini digunakan untuk memantau semua data dalam bentuk grafik dan tabel Excel.',
        ])
        @include('components.monitoring.visualisasi-data')
        @include('components.monitoring.menampilkan-data')

    </div>
@endsection