@extends('layouts.main')

@section('judul')
    Dokumen {{ ucfirst($section) }}
@endsection

@section('deskripsi')
    Halaman dokumen {{ $section }} untuk referensi {{ $reference_id }}
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('shared.ui.dokumen', [
            'documents' => $documents,
            'reference_id' => $reference_id,
            'section' => $section,
            'module_type' => $module_type
        ])
    </div>
@endsection 