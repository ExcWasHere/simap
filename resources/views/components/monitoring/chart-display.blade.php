<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Grafik Analisis Data</h1>
        <div class="flex gap-4">
            <select id="chart-type" class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="line-chart-bulan" selected>Line Chart - Bulan</option>
                <option value="line-chart-tahun">Line Chart - Tahun</option>
            </select>
            <button id="refresh-chart"
                class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-500 transition-colors">
                <i class="fas fa-sync-alt mr-2"></i>Refresh
            </button>
        </div>
    </div>

    <div id="chart-container" class="bg-white p-6 rounded-lg shadow-md">
        <canvas id="monitoringChart" class="w-full h-[400px]"></canvas>
    </div>

    <div id="chart-message" class="bg-white p-6 rounded-lg shadow-md text-center text-gray-500">
        Silakan pilih jenis grafik untuk menampilkan data
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Total Kasus</h3>
            <p class="text-3xl font-bold text-indigo-600">0</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Total Nilai Barang</h3>
            <p class="text-3xl font-bold text-indigo-600">Rp 0</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Rata-rata per Bulan</h3>
            <p class="text-3xl font-bold text-indigo-600">0</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Trend</h3>
            <p class="text-3xl font-bold text-indigo-600">+0%</p>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartType = document.getElementById('chart-type');
        const refreshBtn = document.getElementById('refresh-chart');
        const chartContainer = document.getElementById('chart-container');
        const chartMessage = document.getElementById('chart-message');

        fetchChartData();

        chartType.addEventListener('change', fetchChartData);
        refreshBtn.addEventListener('click', fetchChartData);

        const ctx = document.getElementById('monitoringChart').getContext('2d');
        let chart;

        function initChart(data) {
            if (chart) {
                chart.destroy();
            }

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: 'Jumlah Kasus',
                    datasets: [{
                        label: 'Jumlah Kasus',
                        data: data.values,
                        borderColor: 'rgb(147, 51, 234)',
                        tension: 0.3,
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Monitoring'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });
        }

        function fetchChartData() {
            const chartType = document.getElementById('chart-type').value;
            fetch(`/api/monitoring/chart-data?type=${chartType}`)
                .then(response => response.json())
                .then(data => {
                    initChart(data);
                })
                .catch(error => console.error('Error fetching chart data:', error));
        }
    });
</script>
@endpush
