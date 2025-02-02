@extends('layouts.main')

@section('judul')
    Grafik Monitoring
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('components.monitoring.display-chart')
    </div>
@endsection