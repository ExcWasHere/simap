<figure
    class="flex flex-col justify-between overflow-hidden p-6 rounded-lg shadow-md transform transition-all duration-300 bg-slate-50 hover:bg-slate-100">
    <figcaption class="flex items-center gap-4 mb-4">
        <i class="fas fa-file-excel p-3 rounded-lg text-2xl bg-purple-100 text-emerald-600"></i>
        <div class="cursor-default">
            <h3 class="text-lg font-semibold text-gray-900">Data Excel</h3>
            <h5 class="text-sm text-gray-600">Unduh dan kelola data dalam format Excel</h5>
        </div>
    </figcaption>
    <div class="space-y-4 mb-4">
        @include('shared.forms.radio-input', [
    'name' => 'data-excel',
    'id' => 'semua-data',
    'label' => 'Semua Data',
    'checked' => true
])

        @include('shared.forms.radio-input', [
    'name' => 'data-excel',
    'id' => 'data-per-bulan',
    'label' => 'Data Per Bulan'
])

        @include('shared.forms.radio-input', [
    'name' => 'data-excel',
    'id' => 'rekap-tahunan',
    'label' => 'Rekap Tahunan'
])
    </div>
    <button
        class="mt-4 cursor-pointer w-full py-3 rounded-lg transition-colors bg-emerald-600 text-emerald-50 hover:bg-emerald-500">
        Unduh Excel
    </button>
    </>