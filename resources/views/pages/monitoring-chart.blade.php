@extends('layouts.main')

@section('judul')
    Grafik Monitoring
@endsection

@section('deskripsi')
    Data jadi nggak bikin pusing dengan grafik interaktif keren ini. Yuk, cek semuanya di sini!
@endsection

@section('konten')
    @include('shared.navigation.back')
    @include('components.monitoring.display-chart')
@endsection