<section class="mb-6 p-4 flex items-center gap-4 rounded-lg shadow bg-white">
    <form action="{{ url()->current() }}" method="GET" class="flex-1 flex items-center gap-4">
        <div class="relative flex-1">
            <input type="search" name="search" value="{{ request('search') }}"
                placeholder="{{ $placeholder ?? 'Cari data...' }}"
                class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            <i class="fas fa-search absolute top-4 left-4 text-gray-400"></i>
        </div>
        <button type="submit"
            class="flex cursor-pointer items-center gap-2 px-4 py-3 border rounded-lg transition-colors duration-300 border-gray-300 text-gray-600 hover:bg-gray-50">
            <i class="fas fa-search"></i>
            <h5 class="hidden lg:inline">Cari</h5>
        </button>
    </form>
    <button onclick="open_modal('modal_filter')"
        class="flex cursor-pointer items-center gap-2 px-4 py-3 border rounded-lg transition-colors duration-300 border-gray-300 text-gray-600 hover:bg-gray-50">
        <i class="fas fa-filter"></i>
        <h5 class="hidden lg:inline">Filter</h5>
    </button>
    <button id="download-btn" data-section="{{ $section ?? '' }}"
        class="flex cursor-pointer items-center gap-2 px-4 py-3 border rounded-lg transition-colors duration-300 border-gray-300 text-gray-600 hover:bg-gray-50">
        <i class="fas fa-download"></i>
        <h5 class="hidden lg:inline">Download</h5>
    </button>
    <button onclick="open_modal('modal_tambah', '{{ $section }}')"
        class="flex cursor-pointer items-center gap-2 px-4 py-3 border rounded-lg transition-colors duration-300 border-gray-300 text-gray-600 hover:bg-gray-50">
        <i class="fas fa-plus"></i>
        <h5 class="hidden lg:inline">Tambah Data</h5>
    </button>
</section>

@if(request('date_from') || request('date_to'))
    <a href="{{ url()->current() }}"
        class="inline-block mb-4 cursor-pointer px-4 py-2 rounded-lg transition-colors duration-300 bg-red-600 text-white hover:bg-red-700">
        Hapus Filter
    </a>
@endif

@include('shared.ui.modal-tambah', ['activeTab' => $section])
