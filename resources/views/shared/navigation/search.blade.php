<section class="mb-6 p-4 flex items-center gap-4 rounded-lg shadow bg-white">
    <div class="relative flex-1">
        <input
            type="search"
            placeholder="{{ $placeholder ?? 'Cari data...' }}"
            class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"    
        />
        <i class="fas fa-search absolute top-4 left-4 text-gray-400"></i>
    </div>
    <button class="flex cursor-pointer items-center gap-2 px-4 py-3 border rounded-lg transition-colors duration-300 border-gray-300 text-gray-600 hover:bg-gray-50">
        <i class="fas fa-filter"></i>
        <h5 class="hidden lg:inline">Filter</h5>
    </button>
    <button class="flex cursor-pointer items-center gap-2 px-4 py-3 border rounded-lg transition-colors duration-300 border-gray-300 text-gray-600 hover:bg-gray-50">
        <i class="fas fa-download"></i>
        <h5 class="hidden lg:inline">Download</h5>
    </button>
</section>