<figure id="{{ $id_modal }}" class="hidden min-h-screen [.modal-active]:flex items-center justify-center px-4 fixed inset-0 z-50 overflow-y-auto">
    <div class="fixed inset-0 bg-black/50 transition-opacity"></div>
    <section class="relative w-full max-w-4xl rounded-lg bg-white shadow-xl">
        <header class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-900" id="modal_title">
                {{ $title }}
            </h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="close_modal('{{ $id_modal }}')">
                <i class="fas fa-times text-xl"></i>
            </button>
        </header>
        <div class="max-h-[calc(100vh-200px)] overflow-y-auto px-6 py-4">
            {{ $slot }}
        </div>
        <footer class="flex justify-end gap-3 border-t px-6 py-4">
            <form action="" method="POST">
                <button type="submit" class="cursor-pointer px-4 py-2 rounded-lg transition-colors duration-300 bg-blue-600 text-white hover:bg-blue-700">
                    Simpan
                </button>
            </form>
            <button
                type="submit"
                class="cursor-pointer rounded-lg px-4 py-2 text-sm font-medium transition-colors duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200"
                onclick="close_modal('{{ $id_modal }}')"
            >
                Tutup
            </button>
            {{ $footer ?? '' }}
        </footer>
    </section>
</figure>