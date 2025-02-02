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
    <div class="container mx-auto pt-12 pb-6">
        @include('components.penindakan.main')
    </div>
@endsection