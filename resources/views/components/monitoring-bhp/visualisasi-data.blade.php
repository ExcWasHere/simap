<section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <figure class="flex flex-col justify-between overflow-hidden p-6 rounded-lg shadow-md transform transition-all duration-300 bg-slate-50 hover:shadow-xl">
        <figcaption class="flex items-center gap-4 mb-4">
            <i class="fas fa-chart-line p-3 rounded-lg text-2xl bg-purple-100 text-purple-600"></i>
            <div class="cursor-default">
                <h3 class="text-lg font-semibold text-gray-900">Grafik Analisis</h3>
                <h5 class="text-sm text-gray-600">Visualisasi data dalam bentuk grafik</h5>
            </div>
        </figcaption>
        <div class="space-y-4 h-full">
            <span class="flex items-center gap-2">
                <input type="radio" name="grafik-analisis" id="line-chart-bulan" class="cursor-pointer" />
                <label for="line-chart-bulan" class="cursor-pointer text-gray-700">Line Chart - Bulan</label>
            </span>
            <span class="flex items-center gap-2">
                <input type="radio" name="grafik-analisis" id="line-chart-tahun" class="cursor-pointer" />
                <label for="line-chart-tahun" class="cursor-pointer text-gray-700">Line Chart - Tahun</label>
            </span>
        </div>
        <button class="mt-4 cursor-pointer w-full py-3 rounded-lg transition-colors bg-purple-600 text-purple-50 hover:bg-purple-500">
            Tampilkan Grafik
        </button>
    </figure>
    <figure class="overflow-hidden p-6 rounded-lg shadow-md transform transition-all duration-300 bg-slate-50 hover:shadow-xl">
        <figcaption class="flex items-center gap-4 mb-4">
            <i class="fas fa-file-excel p-3 rounded-lg text-2xl bg-purple-100 text-emerald-600"></i>
            <div class="cursor-default">
                <h3 class="text-lg font-semibold text-gray-900">Data Excel</h3>
                <h5 class="text-sm text-gray-600">Unduh dan kelola data dalam format Excel</h5>
            </div>
        </figcaption>
        <div class="space-y-4 mb-4">
            <span class="flex items-center gap-2">
                <input type="radio" name="data-excel" id="semua-data" class="cursor-pointer" />
                <label for="semua-data" class="cursor-pointer text-gray-700">Semua Data</label>
            </span>
            <span class="flex items-center gap-2">
                <input type="radio" name="data-excel" id="data-per-bulan" class="cursor-pointer" />
                <label for="data-per-bulan" class="cursor-pointer text-gray-700">Data Per Bulan</label>
            </span>
            <span class="flex items-center gap-2">
                <input type="radio" name="data-excel" id="rekap-tahunan" class="cursor-pointer" />
                <label for="rekap-tahunan" class="cursor-pointer text-gray-700">Rekap Tahunan</label>
            </span>
        </div>
        <button class="mt-4 cursor-pointer w-full py-3 rounded-lg transition-colors bg-emerald-600 text-emerald-50 hover:bg-emerald-500">
            Unduh Excel
        </button>
    </figure>
</section>