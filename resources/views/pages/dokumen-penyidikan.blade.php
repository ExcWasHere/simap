@extends('layouts.main')

@section('judul')
    Dokumen Penyidikan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <div class="container mx-auto pt-16 pb-6">
        @include('components.penyidikan.dokumen', ['documents' => $documents, 'no_spdp' => $no_spdp])
    </div>
@endsection