@extends('layouts.main')

@section('judul')
    Dokumen Intelijen
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('components.intelijen.dokumen', ['documents' => $documents, 'no_nhi' => $no_nhi])
    </div>
@endsection