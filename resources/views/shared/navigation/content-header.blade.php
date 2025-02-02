<section class="mb-6 flex items-center justify-between gap-4">
    <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
    @if(isset($button_tambah) && $button_tambah)
        <button
            onclick="open_modal('modal_tambah', '{{ $active_tab ?? 'intelijen' }}')"
            class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Data
        </button>
    @endif
</section>