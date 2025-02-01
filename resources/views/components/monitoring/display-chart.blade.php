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

    <div class="bg-white p-6 rounded-lg shadow-sm">
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
        <div class="h-96 w-full bg-gray-50 rounded-lg border border-gray-200">
            <canvas id="mainChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Dokumen</p>
                    <h4 class="text-xl font-semibold text-gray-900" id="totalDokumen">-</h4>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pertumbuhan (Bulan Ini)</p>
                    <h4 class="text-xl font-semibold text-gray-900" id="pertumbuhan">-</h4>
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
                    <h4 class="text-xl font-semibold text-gray-900" id="avgPerBulan">-</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('mainChart').getContext('2d');
    let mainChart = null;
    let chartData = null;

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            intersect: false,
            mode: 'index'
        },
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                backgroundColor: 'rgba(255, 255, 255, 0.9)',
                titleColor: '#000',
                bodyColor: '#666',
                borderColor: '#ddd',
                borderWidth: 1,
                padding: 10,
                boxPadding: 4
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0
                },
                grid: {
                    borderDash: [2, 2]
                }
            }
        },
        elements: {
            line: {
                tension: 0.4
            },
            point: {
                radius: 4,
                hitRadius: 10,
                hoverRadius: 6
            }
        }
    };

    function createChart(type, data) {
        if (mainChart) {
            mainChart.destroy();
        }

        mainChart = new Chart(ctx, {
            type: type === 'area' ? 'line' : type,
            data: data,
            options: chartOptions
        });
    }

    function updateStats(stats) {
        document.getElementById('totalDokumen').textContent = stats.totalDokumen.toLocaleString();
        document.getElementById('pertumbuhan').textContent = `${stats.pertumbuhan > 0 ? '+' : ''}${stats.pertumbuhan}%`;
        document.getElementById('avgPerBulan').textContent = stats.avgPerBulan.toLocaleString();

        const pertumbuhanEl = document.getElementById('pertumbuhan');
        if (stats.pertumbuhan > 0) {
            pertumbuhanEl.classList.add('text-green-600');
        } else if (stats.pertumbuhan < 0) {
            pertumbuhanEl.classList.add('text-red-600');
        }
    }

    function fetchChartData() {
        const range = document.querySelector('select[name="date-range"]').value;
        const url = new URL('{{ route("monitoring.chart-data") }}');
        url.searchParams.append('range', range);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                chartData = data;
                updateChart();
                updateStats(data.stats);
            });
    }

    function updateChart() {
        const selectedCategory = document.querySelector('select[name="category"]').value;
        const selectedType = document.querySelector('select[name="chart-type"]').value;

        if (!chartData) return;

        const updatedDatasets = chartData.datasets
            .filter(dataset => selectedCategory === 'all' || dataset.label.toLowerCase() === selectedCategory)
            .map(dataset => ({
                ...dataset,
                fill: selectedType === 'area'
            }));

        createChart(selectedType, {
            labels: chartData.labels,
            datasets: updatedDatasets
        });
    }

    document.querySelector('select[name="chart-type"]').value = 'line';
    document.querySelector('select[name="date-range"]').value = '7';

    fetchChartData();

    document.querySelector('select[name="chart-type"]').addEventListener('change', updateChart);

    document.querySelector('select[name="category"]').addEventListener('change', updateChart);

    document.querySelector('select[name="date-range"]').addEventListener('change', fetchChartData);

    document.querySelector('button:has(i.fa-expand)').addEventListener('click', function() {
        const chartContainer = document.getElementById('mainChart').parentElement;
        if (document.fullscreenElement) {
            document.exitFullscreen();
        } else {
            chartContainer.requestFullscreen();
        }
    });
});
</script>
@endpush