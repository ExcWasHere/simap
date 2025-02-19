@extends('layouts.main')

@section('judul')
    Tambah Data Penindakan
@endsection

@section('konten')
    <main class="min-h-screen bg-gray-100 pt-20">
        <div class="max-w-7xl mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-8">Tambah Data Penindakan</h2>

                @if($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('penindakan.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_laporan',
                                'label' => 'Tanggal Laporan',
                                'type' => 'date',
                                'required' => true
                            ])
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Jenis Barang<span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_barang"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jenis_barang') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="NPP">NPP</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                            @error('jenis_barang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_sbp',
                                'label' => 'Nomor SBP',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_sbp',
                                'label' => 'Tanggal SBP',
                                'type' => 'date',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_print',
                                'label' => 'Nomor PRINT',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_print',
                                'label' => 'Tanggal PRINT',
                                'type' => 'date',
                                'required' => true
                            ])
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                @include('shared.forms.input', [
                                    'name' => 'nama_jenis_sarkut',
                                    'label' => 'Nama dan Jenis Sarkut'
                                ])
                            </div>

                            <div>
                                @include('shared.forms.input', [
                                    'name' => 'pengemudi',
                                    'label' => 'Pengemudi'
                                ])
                            </div>

                            <div>
                                @include('shared.forms.input', [
                                    'name' => 'no_polisi',
                                    'label' => 'Nomor Polisi'
                                ])
                            </div>
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'bangunan',
                                'label' => 'Bangunan'
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'nama_pemilik',
                                'label' => 'Pemilik Bangunan'
                            ])
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_ktp',
                                'label' => 'Nomor KTP',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'pelaku',
                                'label' => 'Pemilik',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_hp',
                                'label' => 'Nomor HP',
                                'required' => true
                            ])
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tempat_lahir',
                                'label' => 'Tempat Lahir',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_lahir',
                                'label' => 'Tanggal Lahir',
                                'type' => 'date',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'pekerjaan',
                                'label' => 'Pekerjaan',
                                'required' => true
                            ])
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat<span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" rows="3"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('alamat') border-red-500 ring-1 ring-red-500 @enderror"
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi Penindakan<span class="text-red-500">*</span>
                            </label>
                            <textarea name="lokasi_penindakan" rows="3"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('lokasi_penindakan') border-red-500 ring-1 ring-red-500 @enderror"
                                required>{{ old('lokasi_penindakan') }}</textarea>
                            @error('lokasi_penindakan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'waktu_awal_penindakan',
                                'label' => 'Waktu Awal Penindakan',
                                'type' => 'datetime-local',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'waktu_akhir_penindakan',
                                'label' => 'Waktu Akhir Penindakan',
                                'type' => 'datetime-local',
                                'required' => true
                            ])
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Jenis Pelanggaran<span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_pelanggaran"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jenis_pelanggaran') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="DIDUGA MEMILIKI NARKOTIKA DAN/ATAU PSIKOTROPIKA">DIDUGA MEMILIKI NARKOTIKA
                                    DAN/ATAU PSIKOTROPIKA</option>
                            </select>
                            @error('jenis_pelanggaran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pasal<span class="text-red-500">*</span>
                            </label>
                            <select name="pasal"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('pasal') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="PASAL 62 UNDANG - UNDANG NOMOR 5 TAHUN 1997 TENTANG PSIKOTROPIKA">PASAL 62
                                    UNDANG - UNDANG NOMOR 5 TAHUN 1997 TENTANG PSIKOTROPIKA</option>
                            </select>
                            @error('pasal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'uraian_bhp',
                                'label' => 'Uraian BHP',
                                'required' => true
                            ])
                        </div>
                    
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'jumlah',
                                'label' => 'Jumlah',
                                'type' => 'number',
                                'required' => true
                            ])
                        </div>
                    
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Kemasan<span class="text-red-500">*</span>
                            </label>
                            <select name="kemasan"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('kemasan') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="Batang">Batang</option>
                                <option value="Liter">Liter</option>
                            </select>
                            @error('kemasan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @include('shared.forms.mata-uang', [
                                'name' => 'perkiraan_nilai_barang',
                                'label' => 'Perkiraan Nilai Barang',
                                'required' => true
                            ])
                        </div>

                        <div>
                            @include('shared.forms.mata-uang', [
                                'name' => 'potensi_kurang_bayar',
                                'label' => 'Potensi Kurang Bayar'
                            ])
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        @include('shared.forms.signature-pad', [
                            'label' => 'Tanda Tangan Pelaku',
                            'name' => 'ttd_pelaku',
                            'index' => 'pelaku',
                        ])
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Petugas 1<span class="text-red-500">*</span>
                            </label>
                            <select name="petugas_1"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('petugas_1') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="FREDI CANDRA SETIAWAN">FREDI CANDRA SETIAWAN</option>
                            </select>
                            @error('petugas_1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Petugas 2<span class="text-red-500">*</span>
                            </label>
                            <select name="petugas_2"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('petugas_2') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="FREDI CANDRA SETIAWAN">FREDI CANDRA SETIAWAN</option>
                            </select>
                            @error('petugas_2')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-8">
                        <button type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection