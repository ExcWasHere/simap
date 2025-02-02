@extends('layouts.main')

@section('judul')
    Dokumen Monitoring
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('components.monitoring.dokumen', ['documents' => $documents, 'id' => $id])
    </div>
@endsection