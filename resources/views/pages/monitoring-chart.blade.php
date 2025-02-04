@extends('layouts.main')

@section('judul')
    Grafik Monitoring
@endsection

@section('deskripsi')
@endsection

@section('konten')
    @include('shared.navigation.back')
    <div class="container mx-auto py-6">
        @include('components.monitoring.display-chart')
    </div>
@endsection