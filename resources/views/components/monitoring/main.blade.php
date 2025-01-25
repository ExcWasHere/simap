<div class="container mx-auto px-4 py-2">
    <h1 class="text-3xl font-semibold text-gray-900 mb-2">Monitoring</h1>
    
    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-3">
        <p class="text-gray-700">
            Halaman ini digunakan untuk memantau semua data dalam bentuk grafik dan tabel Excel.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Grafik Option Card --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-purple-100 rounded-lg p-3">
                        <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Grafik Analisis</h3>
                        <p class="text-sm text-gray-600">Visualisasi data dalam bentuk grafik</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="radio" name="view_type" id="grafik_pie" class="mr-2" />
                        <label for="grafik_pie" class="text-gray-700">Line Chart - Bulan</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="view_type" id="grafik_line" class="mr-2" />
                        <label for="grafik_line" class="text-gray-700">Line Chart - Tahun</label>
                    </div>
                </div>
                
                <button class="mt-4 w-full py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition-colors">
                    Tampilkan Grafik
                </button>
            </div>
        </div>

        {{-- Excel Option Card --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-emerald-100 rounded-lg p-3">
                        <i class="fas fa-file-excel text-2xl text-emerald-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Data Excel</h3>
                        <p class="text-sm text-gray-600">Unduh dan kelola data dalam format Excel</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="radio" name="excel_type" id="excel_all" class="mr-2" />
                        <label for="excel_all" class="text-gray-700">Semua Data</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="excel_type" id="excel_monthly" class="mr-2" />
                        <label for="excel_monthly" class="text-gray-700">Data per Bulan</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="excel_type" id="excel_yearly" class="mr-2" />
                        <label for="excel_yearly" class="text-gray-700">Rekap Tahunan</label>
                    </div>
                </div>
                
                <button class="mt-4 w-full py-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors">
                    Unduh Excel
                </button>
            </div>
        </div>
    </div>

    {{-- Placeholder for Dynamic Content --}}
    <div id="content-area" class="mt-6 bg-white rounded-lg shadow-md p-6">
        <p class="text-center text-gray-500">Silakan pilih jenis tampilan untuk melihat data</p>
    </div>
</div>