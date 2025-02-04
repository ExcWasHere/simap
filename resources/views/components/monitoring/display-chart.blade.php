<main class="max-w-7xl mx-auto">
    <h3 class="text-2xl font-bold text-gray-900">Visualisasi Data</h3>
    <h5 class="mt-2 mb-8 text-sm text-gray-600">Analisis data dalam bentuk grafik interaktif</h5>
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white rounded-lg shadow-sm p-6 mb-6">
        @include('shared.forms.select', [
            'name' => 'date-range',
            'label' => 'Rentang Waktu',
            'options' => [
                '7' => '7 Hari Terakhir',
                '30' => '30 Hari Terakhir',
                '3' => '3 Bulan Terakhir',
                '1' => '1 Tahun Terakhir',
                'custom' => 'Custom Range',
            ],
        ])
        @include('shared.forms.select', [
            'name' => 'chart-type',
            'label' => 'Jenis Grafik',
            'options' => [
                'line' => 'Line Chart',
                'bar' => 'Bar Chart',
                'area' => 'Area Chart',
            ],
        ])
        @include('shared.forms.select', [
            'name' => 'category',
            'label' => 'Kategori Data',
            'options' => [
                'all' => 'Semua Kategori',
                'intelijen' => 'Intelijen',
                'penindakan' => 'Penindakan',
                'penyidikan' => 'Penyidikan',
            ],
        ])
    </section>
    <section class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-900">Tren Data Keseluruhan</h2>
            <span class="flex gap-2">
                <button class="px-3 py-1 text-sm rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200">
                    <i class="fas fa-download mr-1"></i> Unduh
                </button>
                <button class="px-3 py-1 text-sm rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200">
                    <i class="fas fa-expand mr-1"></i> Layar Penuh
                </button>
            </span>
        </div>
        <canvas id="main-chart" class="h-96 w-full bg-gray-50 rounded-lg border border-gray-200"></canvas>
    </section>
    <section class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-3">
        <figure class="flex items-center p-6 rounded-lg shadow-sm bg-white">
            <i class="fas fa-file-alt text-xl p-3 rounded-full bg-blue-100 text-blue-600"></i>
            <span class="ml-4">
                <h6 class="text-sm text-gray-600">Total Dokumen</h6>
                <h4 class="text-xl font-semibold text-gray-900" id="total_dokumen">-</h4>
            </span>
        </figure>
        <figure class="flex items-center p-6 rounded-lg shadow-sm bg-white">
            <i class="fas fa-chart-line text-xl p-3 rounded-full bg-green-100 text-green-600"></i>
            <span class="ml-4">
                <h6 class="text-sm text-gray-600">Pertumbuhan (Bulan Ini)</h6>
                <h4 class="text-xl font-semibold text-gray-900" id="pertumbuhan">-</h4>
            </span>
        </figure>
        <figure class="flex items-center p-6 rounded-lg shadow-sm bg-white">
            <i class="fas fa-clock text-xl p-3 rounded-full bg-purple-100 text-purple-600"></i>
            <span class="ml-4">
                <h6 class="text-sm text-gray-600">Rata-rata/Bulan</h6>
                <h4 class="text-xl font-semibold text-gray-900" id="average_per_month">-</h4>
            </span>
        </figure>
    </section>
</main>