@extends('layouts.main')

@section('judul')
    Penyidikan
@endsection

@section('deskripsi')
    Dari bukti sampai perkembangan kasus, semua tersusun rapi di sini. Biar proses penyidikan makin tajam dan nggak ada yang
    ketinggalan!
@endsection

@section('active_tab')
    penyidikan
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6">
        @include('shared.navigation.back')
        @include('components.penyidikan.main')
    </main>
@endsection