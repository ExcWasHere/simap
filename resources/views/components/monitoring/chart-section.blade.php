<figure
    class="flex flex-col justify-between overflow-hidden p-6 rounded-lg shadow-md transform transition-all duration-300 bg-slate-50 hover:bg-slate-100">
    <figcaption class="flex items-center gap-4 mb-4">
        <i class="fas fa-chart-line p-3 rounded-lg text-2xl bg-indigo-100 text-indigo-600"></i>
        <div class="cursor-default">
            <h3 class="text-lg font-semibold text-gray-900">Grafik Analisis</h3>
            <h5 class="text-sm text-gray-600">Visualisasi data dalam bentuk grafik</h5>
        </div>
    </figcaption>
    <div class="space-y-4 h-full">
        @include('shared.forms.radio-input', [
            'name' => 'grafik-analisis',
            'id' => 'line-chart-bulan',
            'label' => 'Line Chart - Bulan',
            'checked' => true
        ])

        @include('shared.forms.radio-input', [
            'name' => 'grafik-analisis',
            'id' => 'line-chart-tahun',
            'label' => 'Line Chart - Tahun'
        ])
    </div>
    <a href="{{ route('monitoring.chart') }}"
        class="mt-4 cursor-pointer w-full py-3 rounded-lg transition-colors bg-indigo-600 text-white hover:bg-indigo-500 text-center">
        Tampilkan Grafik
    </a>
</figure>