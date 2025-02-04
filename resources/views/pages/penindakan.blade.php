@extends('layouts.main')

@section('judul')
    Penindakan
@endsection

@section('deskripsi')
@endsection

@section('active_tab')
    penindakan
@endsection

@section('konten')
    @include('shared.navigation.back')
    <div class="container mx-auto py-6">
        @include('components.penindakan.main')
    </div>
@endsection