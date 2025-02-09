@extends('layouts.main')

@section('judul')
    Dokumen Penindakan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full pt-16 pb-6">
        @include('components.penindakan.dokumen', ['documents' => $documents, 'no_sbp' => $no_sbp])
    </main>
@endsection