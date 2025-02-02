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
    <div class="container mx-auto pt-16 pb-6">
        @include('components.penyidikan.main')
    </div>
@endsection