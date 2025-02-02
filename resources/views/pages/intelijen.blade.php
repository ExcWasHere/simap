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
    <div class="container mx-auto pt-16 pb-6">
        @include('components.intelijen.main')
    </div>
@endsection