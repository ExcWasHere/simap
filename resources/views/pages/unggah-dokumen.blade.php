@extends('layouts.main')

@section('judul')
    Unggah Dokumen
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('components.unggah-dokumen.main')
    </div>
@endsection