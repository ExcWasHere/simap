<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Visualisasi Data</h1>
        <p class="mt-2 text-sm text-gray-600">Analisis data dalam bentuk grafik interaktif</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
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
            </div>

            <div>
                @include('shared.forms.select', [
                    'name' => 'chart-type',
                    'label' => 'Jenis Grafik',
                    'options' => [
                        'line' => 'Line Chart',
                        'bar' => 'Bar Chart',
                        'pie' => 'Pie Chart',
                        'area' => 'Area Chart',
                    ],
                ])
            </div>

            <div>
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
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Tren Data Keseluruhan</h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-sm rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-download mr-1"></i> Export
                    </button>
                    <button class="px-3 py-1 text-sm rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-expand mr-1"></i> Fullscreen
                    </button>
                </div>
            </div>
            <div class="h-96 w-full bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center">
                <p class="text-gray-500">Area Grafik Utama</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-md font-semibold text-gray-900 mb-4">Distribusi per Kategori</h3>
            <div class="h-64 w-full bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center">
                <p class="text-gray-500">Area Grafik Pie</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-md font-semibold text-gray-900 mb-4">Perbandingan Bulanan</h3>
            <div class="h-64 w-full bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center">
                <p class="text-gray-500">Area Grafik Bar</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Dokumen</p>
                    <h4 class="text-xl font-semibold text-gray-900">1,234</h4>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pertumbuhan</p>
                    <h4 class="text-xl font-semibold text-gray-900">+15.3%</h4>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Rata-rata/Bulan</p>
                    <h4 class="text-xl font-semibold text-gray-900">102.8</h4>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-flag text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Target Pencapaian</p>
                    <h4 class="text-xl font-semibold text-gray-900">89%</h4>
                </div>
            </div>
        </div>
    </div>
</div>