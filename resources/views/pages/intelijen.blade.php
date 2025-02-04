@extends('layouts.main')

@section('judul')
    Intelijen
@endsection

@section('deskripsi')
@endsection

@section('active_tab')
    intelijen
@endsection

@section('konten')
    @include('shared.navigation.back')
    <div class="container mx-auto py-6">
        @include('components.intelijen.main')
    </div>
@endsection