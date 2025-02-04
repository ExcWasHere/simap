@extends('layouts.main')

@section('judul')
    Dokumen {{ ucfirst($section) }}
@endsection

@section('deskripsi')
    Menampilkan dokumen untuk {{ $section }} dengan ID: {{ $reference_id }}
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('shared.ui.dokumen', [
            'documents' => $documents,
            'reference_id' => $reference_id,
            'section' => $section
        ])
    </div>
@endsection 