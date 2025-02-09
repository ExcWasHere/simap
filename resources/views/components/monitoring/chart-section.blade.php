<figure class="flex flex-col justify-between overflow-hidden p-6 rounded-lg shadow-md transform transition-all duration-300 bg-slate-50 hover:bg-slate-100">
    <figcaption class="flex items-center gap-4 mb-4">
        <i class="fas fa-chart-line p-3 rounded-lg text-2xl bg-indigo-100 text-indigo-600"></i>
        <div class="cursor-default">
            <h3 class="text-lg font-semibold text-gray-900">Grafik Analisis</h3>
            <h5 class="text-sm text-gray-600">Visualisasi data dalam bentuk grafik</h5>
        </div>
    </figcaption>

    <div class="grid grid-cols-2 gap-4 mt-4 mb-6">
        <div class="relative overflow-hidden rounded-lg bg-white p-4 shadow-sm">
            <div class="space-y-3">
                <div class="h-2 w-3/4 bg-indigo-200 rounded animate-pulse"></div>
                <div class="h-24 bg-indigo-100 rounded">
                    <div class="flex items-end justify-between h-full px-2 pt-2">
                        <div class="w-2 bg-indigo-400 rounded-t h-12 animate-pulse"></div>
                        <div class="w-2 bg-indigo-400 rounded-t h-16 animate-pulse"></div>
                        <div class="w-2 bg-indigo-400 rounded-t h-20 animate-pulse"></div>
                        <div class="w-2 bg-indigo-400 rounded-t h-14 animate-pulse"></div>
                        <div class="w-2 bg-indigo-400 rounded-t h-16 animate-pulse"></div>
                    </div>
                </div>
            </div>
            <i class="fas fa-chart-bar text-indigo-400 absolute top-2 right-2"></i>
        </div>

        <div class="relative overflow-hidden rounded-lg bg-white p-4 shadow-sm">
            <div class="space-y-3">
                <div class="h-2 w-1/2 bg-indigo-200 rounded animate-pulse"></div>
                <div class="h-24 bg-indigo-100 rounded">
                    <div class="relative h-full">
                        <div class="absolute inset-0 flex items-end px-2">
                            <div class="w-full h-16 bg-indigo-400/20 rounded-t relative">
                                <div class="absolute inset-0 bg-gradient-to-t from-indigo-400/40 to-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <i class="fas fa-chart-line text-indigo-400 absolute top-2 right-2"></i>
        </div>
    </div>

    <a
        href="{{ route('monitoring.chart') }}"
        class="mt-4 cursor-pointer w-full py-3 rounded-lg transition-colors bg-indigo-600 text-white hover:bg-indigo-500 text-center"
    >
        Tampilkan Grafik
    </a>
</figure>