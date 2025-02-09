@extends('layouts.main')

@section('judul')
    Unggah Dokumen
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full pt-16 pb-6">
        @include('components.unggah-dokumen.main')
    </main>
@endsection