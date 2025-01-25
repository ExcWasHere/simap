<div id="{{ $modalId }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="fixed inset-0 bg-black/50 transition-opacity"></div>

        <div class="relative w-full {{ $maxWidth ?? 'max-w-4xl' }} rounded-lg bg-white shadow-xl">
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">
                    {{ $title }}
                </h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('{{ $modalId }}')">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="max-h-[calc(100vh-200px)] overflow-y-auto px-6 py-4">
                {{ $slot }}
            </div>

            <div class="flex justify-end gap-3 border-t px-6 py-4">
                @if($modalId == 'modalTambah')
                    <div class="flex justify-end gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                @endif
                <button type="button"
                    class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200"
                    onclick="closeModal('{{ $modalId }}')">
                    Tutup
                </button>
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</div>