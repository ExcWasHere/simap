@extends('layouts.main')

@section('judul')
    Grafik Monitoring
@endsection

@section('deskripsi')
    Data jadi nggak bikin pusing dengan grafik interaktif keren ini. Yuk, cek semuanya di sini!
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6">
        @include('shared.navigation.monitoring-back')
        @include('components.monitoring.display-chart')
    </main>
@endsection