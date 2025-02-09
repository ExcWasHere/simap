@extends('layouts.main')

@section('judul')
    Dokumen Monitoring
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full pt-16 pb-6">
        @include('components.monitoring.dokumen', ['documents' => $documents, 'id' => $id])
    </main>
@endsection