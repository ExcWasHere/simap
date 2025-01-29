@php
    $activeTab = old('entity_type', request('entity_type', 'all'));
@endphp

@component('shared.ui.modal-base', [
    'id_modal' => 'modal_filter',
    'title' => 'Filter Data',
])
    <form id="formulir-filter" class="space-y-6" method="GET">
        <input type="hidden" name="search" value="{{ request('search') }}">
        
        <div class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Rentang Tanggal
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <input type="date" name="date_from" 
                            value="{{ request('date_from') }}"
                            class="w-full rounded-lg border-gray-300 pl-2 shadow-sm py-2 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Dari Tanggal">
                    </div>
                    <div>
                        <input type="date" name="date_to" 
                            value="{{ request('date_to') }}"
                            class="w-full rounded-lg border-gray-300 pl-2 shadow-sm py-2 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Sampai Tanggal">
                    </div>
                </div>
            </div>
        </div>

    </form>
@endcomponent 