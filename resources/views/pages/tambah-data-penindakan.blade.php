@extends('layouts.main')

@section('judul')
    Tambah Data Penindakan
@endsection

@section('konten')
    <main class="min-h-screen bg-gray-100 pt-20">
        <div class="max-w-7xl mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-8">Tambah Data Penindakan</h2>
                
                <form method="POST" action="{{ route('penindakan.store') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Laporan<span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" 
                                       name="tanggal_laporan" 
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="dd/mm/yyyy"
                                       required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Jenis Barang<span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_barang" 
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="NPP">NPP</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nomor SBP<span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="no_sbp" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal SBP<span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" 
                                       name="tanggal_sbp" 
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="dd/mm/yyyy"
                                       required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nomor PRINT<span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="no_print" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal PRINT<span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" 
                                       name="tanggal_print" 
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="dd/mm/yyyy"
                                       required>
                            </div>
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama dan Jenis Sarkut
                                </label>
                                <input type="text" 
                                       name="nama_jenis_sarkut" 
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Pengemudi
                                </label>
                                <input type="text" 
                                       name="pengemudi" 
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor Polisi
                                </label>
                                <input type="text" 
                                       name="no_polisi" 
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Bangunan
                            </label>
                            <input type="text" 
                                   name="bangunan" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pemilik Bangunan
                            </label>
                            <input type="text" 
                                   name="nama_pemilik" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nomor KTP<span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="no_ktp" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pemilik<span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="pelaku" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nomor HP<span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="no_hp" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tempat Lahir<span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="tempat_lahir" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tanggal Lahir<span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_lahir" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pekerjaan<span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="pekerjaan" 
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat<span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" rows="3"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                      required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi Penindakan<span class="text-red-500">*</span>
                            </label>
                            <textarea name="lokasi_penindakan" rows="3"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                      required></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Waktu Awal Penindakan<span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="waktu_awal_penindakan"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Waktu Akhir Penindakan<span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="waktu_akhir_penindakan"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Jenis Pelanggaran<span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_pelanggaran"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="DIDUGA MEMILIKI NARKOTIKA DAN/ATAU PSIKOTROPIKA">DIDUGA MEMILIKI NARKOTIKA DAN/ATAU PSIKOTROPIKA</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Pasal<span class="text-red-500">*</span>
                            </label>
                            <select name="pasal"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="PASAL 62 UNDANG - UNDANG NOMOR 5 TAHUN 1997 TENTANG PSIKOTROPIKA">PASAL 62 UNDANG - UNDANG NOMOR 5 TAHUN 1997 TENTANG PSIKOTROPIKA</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Petugas 1<span class="text-red-500">*</span>
                            </label>
                            <select name="petugas_1"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="FREDI CANDRA SETIAWAN">FREDI CANDRA SETIAWAN</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Petugas 2<span class="text-red-500">*</span>
                            </label>
                            <select name="petugas_2"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="FREDI CANDRA SETIAWAN">FREDI CANDRA SETIAWAN</option>
                            </select>
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