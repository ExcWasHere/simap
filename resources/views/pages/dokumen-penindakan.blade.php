@extends('layouts.main')

@section('judul')
    Dokumen Penindakan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('components.penindakan.dokumen', ['documents' => $documents, 'no_sbp' => $no_sbp])
    </div>
@endsection