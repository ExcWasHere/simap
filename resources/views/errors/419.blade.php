@extends('layouts.main')

@section('judul')
    419: Halaman Kadaluarsa
@endsection

@section('deskripsi')

@endsection

@section('konten')
    <section
        class="min-h-screen flex flex-col h-full w-full items-center justify-center bg-center bg-cover bg-no-repeat"
        style="background: url({{ asset('img/latar-belakang.svg') }})"
    >
        <h5 class="cursor-default font-bold text-3xl text-red-700">419 | Halaman Kadaluarsa</h5>
        <a href="/" class="mt-5 flex items-center px-5 py-3 rounded-lg bg-red-700 text-slate-50 transition-all duration-300 ease-in-out hover:bg-red-600">
            <i class="fa-solid fa-home mr-3"></i>
            <h5>Kembali Ke Dasbor</h5>
        </a>
    </section>
@endsection