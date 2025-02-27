@extends('layouts.main')

@section('judul')
    Tambah Data Penindakan
@endsection

@section('konten')
    <main class="min-h-screen bg-gray-100 pt-20">
        <div class="max-w-7xl mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-8">Tambah Data Penindakan</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 101.414 1.414L10 11.414l1.293 1.293a1 1 001.414-1.414L11.414 10l1.293-1.293a1 1 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <ul class="text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('penindakan.store') }}" class="space-y-6" id="penindakan-form">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_laporan',
                                'label' => 'Tanggal Laporan',
                                'type' => 'date',
                                'required' => true,
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
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_sbp',
                                'label' => 'Tanggal SBP',
                                'type' => 'date',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_print',
                                'label' => 'Nomor PRINT',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_print',
                                'label' => 'Tanggal PRINT',
                                'type' => 'date',
                                'required' => true,
                            ])
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                @include('shared.forms.input', [
                                    'name' => 'nama_jenis_sarkut',
                                    'label' => 'Nama dan Jenis Sarkut',
                                ])
                            </div>

                            <div>
                                @include('shared.forms.input', [
                                    'name' => 'pengemudi',
                                    'label' => 'Pengemudi',
                                ])
                            </div>

                            <div>
                                @include('shared.forms.input', [
                                    'name' => 'no_polisi',
                                    'label' => 'Nomor Polisi',
                                ])
                            </div>
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'bangunan',
                                'label' => 'Bangunan',
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'nama_pemilik',
                                'label' => 'Pemilik Bangunan',
                            ])
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_ktp',
                                'label' => 'Nomor KTP',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'pelaku',
                                'label' => 'Pemilik',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_hp',
                                'label' => 'Nomor HP',
                                'required' => true,
                            ])
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tempat_lahir',
                                'label' => 'Tempat Lahir',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_lahir',
                                'label' => 'Tanggal Lahir',
                                'type' => 'date',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'pekerjaan',
                                'label' => 'Pekerjaan',
                                'required' => true,
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
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'waktu_akhir_penindakan',
                                'label' => 'Waktu Akhir Penindakan',
                                'type' => 'datetime-local',
                                'required' => true,
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
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'jumlah',
                                'label' => 'Jumlah',
                                'type' => 'number',
                                'required' => true,
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
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.mata-uang', [
                                'name' => 'potensi_kurang_bayar',
                                'label' => 'Potensi Kurang Bayar',
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
                            <select name="petugas_1" id="petugas_1"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('petugas_1') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="">Pilih Petugas</option>
                                <option value="FREDI CANDRA SETIAWAN" data-signature="/img/signatures/fredi.png">FREDI
                                    CANDRA SETIAWAN</option>
                            </select>
                            <input type="hidden" name="ttd_petugas_1" id="ttd_petugas_1">
                            @error('petugas_1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Petugas 2<span class="text-red-500">*</span>
                            </label>
                            <select name="petugas_2" id="petugas_2"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('petugas_2') border-red-500 ring-1 ring-red-500 @enderror"
                                required>
                                <option value="">Pilih Petugas</option>
                                <option value="FREDI CANDRA SETIAWAN" data-signature="/img/signatures/fredi.png">FREDI
                                    CANDRA SETIAWAN</option>
                            </select>
                            <input type="hidden" name="ttd_petugas_2" id="ttd_petugas_2">
                            @error('petugas_2')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-8">
                        @if (config('app.debug'))
                            <button type="button" id="debug-autofill"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Debug Autofill
                            </button>
                        @endif
                        <a href="{{ url()->previous() }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" id="submit-button"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span id="submit-text">Simpan</span>
                            <span id="submit-spinner" class="hidden"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @push('skrip')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('penindakan-form');
                const submitButton = document.getElementById('submit-button');
                const submitText = document.getElementById('submit-text');
                const submitSpinner = document.getElementById('submit-spinner');

                form.addEventListener('submit', function() {
                    submitButton.disabled = true;
                    submitText.classList.add('hidden');
                    submitSpinner.classList.remove('hidden');
                });

                const petugas1Select = document.getElementById('petugas_1');
                const petugas2Select = document.getElementById('petugas_2');
                const ttdPetugas1Input = document.getElementById('ttd_petugas_1');
                const ttdPetugas2Input = document.getElementById('ttd_petugas_2');

                async function handlePetugasChange(select, ttdInput) {
                    select.addEventListener('change', async function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const signaturePath = selectedOption.dataset.signature;

                        if (signaturePath) {
                            try {
                                const response = await fetch(signaturePath);
                                if (!response.ok) throw new Error('Failed to fetch signature');
                                const blob = await response.blob();
                                const reader = new FileReader();
                                reader.onloadend = () => {
                                    ttdInput.value = reader.result.split(',')[1];
                                };
                                reader.readAsDataURL(blob);
                            } catch (error) {
                                console.error('Error loading signature:', error);
                            }
                        } else {
                            ttdInput.value = '';
                        }
                    });
                }

                handlePetugasChange(petugas1Select, ttdPetugas1Input);
                handlePetugasChange(petugas2Select, ttdPetugas2Input);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('penindakan-form');
                const submitButton

                const debugButton = document.getElementById('debug-autofill');
                if (debugButton) {
                    debugButton.addEventListener('click', function() {
                        const randomString = (length = 8) => Math.random().toString(36).substring(2, length +
                            2);

                        const today = new Date().toISOString().split('T')[0];
                        const tomorrow = new Date(Date.now() + 86400000).toISOString().split('T')[0];

                        const randomTime = () => {
                            const hours = String(Math.floor(Math.random() * 24)).padStart(2, '0');
                            const minutes = String(Math.floor(Math.random() * 60)).padStart(2, '0');
                            return `${hours}:${minutes}`;
                        };

                        const debugData = {
                            // Data SBP
                            'tanggal_laporan': today,
                            'jenis_barang': 'NPP',
                            'no_sbp': `SBP/${randomString(6)}/${today.replace(/-/g, '')}`,
                            'tanggal_sbp': today,
                            'no_print': randomString(8).toUpperCase(),
                            'tanggal_print': today,

                            // Informasi Barang
                            'uraian_bhp': 'Contoh uraian barang hasil penindakan untuk debugging',
                            'jumlah': Math.floor(Math.random() * 100) + 1,
                            'kemasan': 'Batang',
                            'perkiraan_nilai_barang': Math.floor(Math.random() * 1000000) + 100000,
                            'potensi_kurang_bayar': Math.floor(Math.random() * 500000) + 50000,

                            // Lokasi dan Waktu
                            'lokasi_penindakan': 'Jl. Test Debug No. ' + Math.floor(Math.random() * 100),
                            'waktu_awal_penindakan': today + 'T' + randomTime(),
                            'waktu_akhir_penindakan': tomorrow + 'T' + randomTime(),

                            // Sarana Pengangkut
                            'nama_jenis_sarkut': 'Mobil',
                            'pengemudi': 'Debug Driver ' + randomString(4),
                            'no_polisi': `B ${Math.floor(Math.random() * 9999)} XX`,
                            'bangunan': 'Gedung Test ' + randomString(4),

                            // Data Pelaku
                            'pelaku': 'Test Pelaku ' + randomString(4),
                            'nama_pemilik': 'Test Pemilik ' + randomString(4),
                            'no_ktp': Math.floor(Math.random() * 9000000000000000) + 1000000000000000,
                            'no_hp': '08' + Math.floor(Math.random() * 90000000) + 10000000,
                            'tempat_lahir': 'Kota ' + randomString(6),
                            'tanggal_lahir': '1990-01-01',
                            'pekerjaan': 'Wiraswasta',
                            'alamat': 'Jl. Debug No. ' + Math.floor(Math.random() * 100) + ', Jakarta',

                            // Informasi Pelanggaran
                            'jenis_pelanggaran': 'DIDUGA MEMILIKI NARKOTIKA DAN/ATAU PSIKOTROPIKA',
                            'pasal': 'PASAL 62 UNDANG - UNDANG NOMOR 5 TAHUN 1997 TENTANG PSIKOTROPIKA',

                            // Data Petugas
                            'petugas_1': 'FREDI CANDRA SETIAWAN',
                            'petugas_2': 'FREDI CANDRA SETIAWAN'
                        };

                        Object.keys(debugData).forEach(key => {
                            const element = document.querySelector(`[name="${key}"]`);
                            if (element) {
                                element.value = debugData[key];
                                if (element.tagName === 'SELECT') {
                                    element.dispatchEvent(new Event('change'));
                                }
                            }
                        });

                        console.log('Debug data filled:', debugData);
                    });
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const noSbpInput = document.querySelector('input[name="no_sbp"]');
                if (noSbpInput) {
                    noSbpInput.addEventListener('blur', function(e) {
                        const inputValue = e.target.value.trim();
                        if (/^\d+$/.test(inputValue)) {
                            const currentYear = new Date().getFullYear();
                            e.target.value = `SBP-${inputValue}/Mandiri/KBC.120302/${currentYear}`;
                        }
                    });
                    noSbpInput.dataset.rawNumber = '';
                    noSbpInput.addEventListener('input', function(e) {
                        const inputValue = e.target.value;
                        if (/^\d+$/.test(inputValue)) {
                            noSbpInput.dataset.rawNumber = inputValue;
                        }
                    });
                }
            });
            document.addEventListener('DOMContentLoaded', function() {
                const noSbpInput = document.querySelector('input[name="no_sbp"]');
                if (noSbpInput) {
                    noSbpInput.addEventListener('input', function(e) {
                        e.target.value = e.target.value.replace(/\D/g, '');
                    });
                }
            });
        </script>
    @endpush
@endsection

