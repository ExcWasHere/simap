@extends('layouts.main')

@section('judul')
    Penyidikan
@endsection

@section('deskripsi')
@endsection

@section('active_tab')
    penyidikan
@endsection

@section('konten')
    @include('shared.navigation.back')
    <div class="container mx-auto py-6">
        @include('components.penyidikan.main')
    </div>
@endsection