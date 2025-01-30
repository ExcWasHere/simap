<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Upload Dokumen Baru</h2>
            <p class="text-gray-600 mt-1">Silakan upload dokumen PDF yang akan ditambahkan</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <p class="font-medium">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <p class="font-medium">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('upload.dokumen') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                    Judul Dokumen
                </label>
                <input 
                    type="text" 
                    name="judul" 
                    id="judul" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan judul dokumen"
                    required
                >
            </div>

            <div>
                <label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">
                    Tipe Dokumen
                </label>
                <select 
                    name="tipe" 
                    id="tipe" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    required
                >
                    <option value="">Pilih Tipe Dokumen</option>
                    <option value="ST-I">ST-I</option>
                    <option value="LPTI">LPTI</option>
                    <option value="LPPI">LPPI</option>
                    <option value="LKAI">LKAI</option>
                    <option value="NHI">NHI</option>
                    <option value="NI">NI</option>
                    <option value="LK">LK</option>
                    <option value="SPTP">SPTP</option>
                    <option value="SPDP">SPDP</option>
                    <option value="TAP SITA">TAP SITA</option>
                    <option value="P2I">P2I</option>
                    <option value="KEP-BDN">KEP-BDN</option>
                    <option value="KEP-BMN">KEP-BMN</option>
                    <option value="KEP-UR">KEP-UR</option>
                    <option value="STCK">STCK</option>
                    <option value="PRIN">PRIN</option>
                    <option value="ST">ST</option>
                    <option value="BA-Pemeriksaan">BA-Pemeriksaan</option>
                    <option value="BA-Penegahan">BA-Penegahan</option>
                    <option value="BAST">BAST</option>
                    <option value="BA-Dokumentasi">BA-Dokumentasi</option>
                    <option value="BA-Pencacahan">BA-Pencacahan</option>
                    <option value="BA-Penyegelan">BA-Penyegelan</option>
                    <option value="SBP">SBP</option>
                    <option value="LPHP">LPHP</option>
                    <option value="LP/LP1">LP/LP1</option>
                    <option value="LPP">LPP</option>
                    <option value="LPF">LPF</option>
                    <option value="SPLIT">SPLIT</option>
                    <option value="LHP">LHP</option>
                    <option value="LRP">LRP</option>
                </select>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea 
                    name="deskripsi" 
                    id="deskripsi" 
                    rows="4" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan deskripsi dokumen"
                    required
                ></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Upload File PDF
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload file</span>
                                <input id="file" name="file" type="file" class="sr-only" accept=".pdf" required>
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PDF hingga 10MB
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Upload Dokumen
                </button>
            </div>
        </form>
    </div>
</div>