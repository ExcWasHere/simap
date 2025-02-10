@extends('layouts.main')

@section('judul')
    Tambah Data Penindakan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="container mx-auto min-h-screen h-full px-4 py-6">
        @php
            $active_tab = old('entity_type', 'penindakan');
        @endphp
        @include('shared.navigation.back')
        <section class="container mt-6 mx-auto shadow rounded-lg pb-10 pt-6 px-10 sm:px-6 md:px-8">
            <h1 class="mx-auto mb-6 text-2xl font-semibold text-gray-900">
                Tambah Data
            </h1>
            <form id="formulir-tambah-data" class="space-y-6" method="POST" action="{{ route('penindakan.store') }}">
                @csrf
                <input type="hidden" name="entity_type" id="entity_type" value="{{ $active_tab }}">
                @if ($errors->any())
                    <ul class="mb-4 p-4 bg-red-50 list-disc pl-5 text-red-700 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <section class="tab-content {{ $active_tab === 'penindakan' ? 'active' : 'hidden' }}" id="penindakan-content" data-content="penindakan">
                    <div class="grid grid-cols-1 gap-6">
                        @include('shared.forms.input', [
                            'label' => 'Tanggal Laporan',
                            'name' => 'tanggal_laporan',
                            'type' => 'date',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Jenis Barang',
                            'name' => 'jenis_barang',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                        @include('shared.forms.input', [
                            'label' => 'No. SBP',
                            'name' => 'no_sbp',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                        @include('shared.forms.input', [
                            'label' => 'Tanggal SBP',
                            'name' => 'tanggal_sbp',
                            'type' => 'date',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'No. PRINT',
                            'name' => 'no_print',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Tanggal PRINT',
                            'name' => 'tanggal_print',
                            'type' => 'date',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Nama dan Jenis Sarkut',
                            'name' => 'nama_jenis_sarkut',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Pengemudi',
                            'name' => 'pengemudi',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Nomor Polisi',
                            'name' => 'no_polisi',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Bangunan',
                            'name' => 'bangunan',
                            'type' => 'text',
                            'data_required' => true,
                        ]) @include('shared.forms.input', [
                            'label' => 'Pemilik Bangunan',
                            'name' => 'nama_pemilik',
                            'type' => 'text',
                            'data_required' => true,
                        ]) @include('shared.forms.input', [
                            'label' => 'Nomor KTP',
                            'name' => 'no_ktp',
                            'type' => 'number',
                            'data_required' => true,
                        ])
                        @include('shared.forms.input', [
                            'label' => 'Pelaku',
                            'name' => 'pelaku',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Nomor HP',
                            'name' => 'no_hp',
                            'type' => 'number',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Tempat Lahir',
                            'name' => 'tempat_lahir',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Tanggal Lahir',
                            'name' => 'tanggal_lahir',
                            'type' => 'date',
                            'data_required' => true,
                        ]) 
                        @include('shared.forms.input', [
                            'label' => 'Pekerjaan',
                            'name' => 'pekerjaan',
                            'type' => 'text',
                            'data_required' => true,
                        ]) 
                        @include('shared.forms.input', [
                            'label' => 'Alamat',
                            'name' => 'alamat',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                        @include('shared.forms.textarea', [
                            'label' => 'Lokasi Penindakan',
                            'name' => 'lokasi_penindakan',
                            'rows' => 3,
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Waktu Awal Penindakan',
                            'name' => 'waktu_awal_penindakan',
                            'type' => 'datetime-local',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Waktu Akhir Penindakan',
                            'name' => 'waktu_akhir_penindakan',
                            'type' => 'datetime-local',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Jenis Pelanggaran',
                            'name' => 'jenis_pelanggaran',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Pasal',
                            'name' => 'pasal',
                            'type' => 'text',
                            'data_required' => true,
                        ])
                        @include('shared.forms.textarea', [
                            'label' => 'Uraian BHP',
                            'name' => 'uraian_bhp',
                            'rows' => 2,
                            'data_required' => true,
                        ])
                        @include('shared.forms.input', [
                            'label' => 'Jumlah',
                            'name' => 'jumlah',
                            'type' => 'number',
                            'data_required' => true,
                        ])
                        @include('shared.forms.select', [
                            'label' => 'Kemasan',
                            'name' => 'kemasan',
                            'options' => [
                                'batang' => 'Batang',
                                'liter' => 'Liter',
                            ],
                        ])
                        @include('shared.forms.mata-uang', [
                            'label' => 'Perkiraan Nilai Barang',
                            'name' => 'perkiraan_nilai_barang',
                            'data_required' => true,
                        ])
                        @include('shared.forms.mata-uang', [
                            'label' => 'Potensi Kurang Bayar',
                            'name' => 'potensi_kurang_bayar',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Petugas 1',
                            'name' => 'petugas_1',
                            'type' => 'name',
                            'data_required' => true,
                        ])
                         @include('shared.forms.input', [
                            'label' => 'Petugas 2',
                            'name' => 'petugas_2',
                            'type' => 'name',
                            'data_required' => true,
                        ])
                    </div>
                    @include('shared.forms.signature-pad', [
                        'label' => 'Tanda Tangan Petugas 1',
                        'name' => 'ttd_petugas_1',
                        'index' => 1,
                    ])
                    @include('shared.forms.signature-pad', [
                        'label' => 'Tanda Tangan Petugas 2',
                        'name' => 'ttd_petugas_2',
                        'index' => 2,
                    ])
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