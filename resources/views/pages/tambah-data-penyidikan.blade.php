@extends('layouts.main')

@section('judul')
    Tambah Data Penyidikan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6">
        @php
            $active_tab = old('entity_type', 'penyidikan');
        @endphp
        @include('shared.navigation.back')
        <section class="container mt-16 mx-auto shadow rounded-lg pb-10 pt-6 px-10 sm:px-6 md:px-8">
            <h1 class="mx-auto mb-6 text-2xl font-semibold text-gray-900">
                Tambah Data
            </h1>
            <form id="formulir-tambah-data" class="space-y-6" method="POST" action="{{ route('penyidikan.store') }}">
                @csrf
                <input type="hidden" name="entity_type" id="entity_type" value="{{ $active_tab }}">
                @if ($errors->any())
                    <ul class="mb-4 p-4 bg-red-50 list-disc pl-5 text-red-700 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <section class="tab-content {{ $active_tab === 'penyidikan' ? 'active' : 'hidden' }}" id="penyidikan-content" data-content="penyidikan">
                    <div class="grid grid-cols-1 gap-6">
                        @include('shared.forms.input', [
                            'label' => 'No. SPDP',
                            'name' => 'no_spdp',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                        @include('shared.forms.input', [
                            'label' => 'Tanggal SPDP',
                            'name' => 'tanggal_spdp',
                            'type' => 'date',
                            'data_required' => true,
                        ])
                        @include('shared.forms.input', [
                            'label' => 'Pelaku',
                            'name' => 'pelaku',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                        @include('shared.forms.textarea', [
                            'label' => 'Keterangan',
                            'name' => 'penyidikan_keterangan',
                            'rows' => 3,
                        ])
                    </div>
                </section>
                <span class="flex justify-end space-x-3 pt-6">
                    <a href="{{ url()->previous() }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan
                    </button>
                </span>
            </form>
        </section>
    </main>
@endsection