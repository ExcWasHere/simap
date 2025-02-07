@props(['id_modal', 'title'])

<figure
    id="{{ $id_modal }}"
    class="fixed inset-0 z-50 hidden overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    <section class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
        <span class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></span>
        <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <span class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                    {{ $title }}
                </h3>
                <button type="button" onclick="close_modal('{{ $id_modal }}')" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </span>
            <article class="px-6 py-4">
                {{ $slot }}
            </article>
            <span class="flex justify-end space-x-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
                <button
                    type="button"
                    onclick="close_modal('{{ $id_modal }}')"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Batal
                </button>
                @if ($id_modal === 'modal_edit')
                    <button
                        type="submit"
                        form="edit-form"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Simpan Perubahan
                    </button>
                @endif
            </span>
        </div>
    </section>
</figure>

@push('skrip')
    <script>
        function close_modal(modal_id) document.getElementById(modal_id).classList.add('hidden');
    </script>
@endpush