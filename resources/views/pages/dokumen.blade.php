@extends('layouts.main')

@section('judul')
    Dokumen {{ ucfirst($section) }}
@endsection

@section('deskripsi')
    Halaman dokumen {{ $section }} untuk referensi {{ $reference_id }}
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full pt-16 pb-6">
        @include('shared.ui.dokumen', [
            'documents' => $documents,
            'reference_id' => $reference_id,
            'section' => $section,
            'module_type' => $module_type
        ])
    </main>
@endsection 