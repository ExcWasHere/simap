@extends('layouts.main')

@section('judul')
    Dokumen Intelijen
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full pt-16 pb-6">
        @include('components.intelijen.dokumen', ['documents' => $documents, 'no_nhi' => $no_nhi])
    </main>
@endsection