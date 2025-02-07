@php
    $active_tab = old('entity_type', request('entity_type', 'all'));
@endphp

@component('shared.ui.modal-base', [
    'id_modal' => 'modal_filter',
    'title' => 'Filter Data',
])
    <form id="formulir-filter" class="space-y-6" method="GET">
        <input type="hidden" name="search" value="{{ request('search') }}">
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Filter Cepat
                </label>
                <div class="flex flex-wrap gap-2">
                    <button type="button" onclick="setDateRange('today')" class="px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Hari Ini
                    </button>
                    <button type="button" onclick="setDateRange('week')" class="px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Minggu Ini
                    </button>
                    <button type="button" onclick="setDateRange('month')" class="px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Bulan Ini
                    </button>
                    <button type="button" onclick="setDateRange('year')" class="px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Tahun Ini
                    </button>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-3 bg-white text-sm text-gray-500">atau pilih rentang tanggal</span>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Rentang Tanggal
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <input type="date" name="date_from" id="date_from"
                            value="{{ request('date_from') }}"
                            class="w-full rounded-lg border-gray-300 pl-2 shadow-sm py-2 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Dari Tanggal">
                    </div>
                    <div>
                        <input type="date" name="date_to" id="date_to"
                            value="{{ request('date_to') }}"
                            class="w-full rounded-lg border-gray-300 pl-2 shadow-sm py-2 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Sampai Tanggal">
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('skrip')
    <script>
        function setDateRange(period) {
            const today = new Date();
            let fromDate = new Date();
            let toDate = new Date();

            switch(period) {
                case 'today':
                    break;
                case 'week':
                    const day = today.getDay();
                    const diff = today.getDate() - day + (day === 0 ? -6 : 1);
                    fromDate = new Date(today.setDate(diff));
                    toDate = new Date(fromDate);
                    toDate.setDate(fromDate.getDate() + 6);
                    break;
                case 'month':
                    fromDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    toDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                    break;
                case 'year':
                    fromDate = new Date(today.getFullYear(), 0, 1);
                    toDate = new Date(today.getFullYear(), 11, 31);
                    break;
            }

            document.getElementById('date_from').value = fromDate.toISOString().split('T')[0];
            document.getElementById('date_to').value = toDate.toISOString().split('T')[0];
        }
    </script>
    @endpush
@endcomponent 