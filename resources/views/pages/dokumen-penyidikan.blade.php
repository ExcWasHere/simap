@extends('layouts.main')

@section('judul')
    Dokumen Penyidikan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6 pt-16 pb-6">
        @include('components.penyidikan.dokumen', ['documents' => $documents, 'no_spdp' => $no_spdp])
    </main>
@endsection