<div class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="search" placeholder="{{ $placeholder ?? 'Cari data...' }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 border text-gray-600 border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <i class="fas fa-filter text-gray-600"></i>
                    Filter
                </button>
                <button class="px-4 py-2 border text-gray-600 border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <i class="fas fa-download text-gray-600"></i>
                    Export
                </button>
            </div>
        </div>
    </div>