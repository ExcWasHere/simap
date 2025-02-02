<figure id="{{ $id_modal }}"
    class="hidden min-h-screen [.modal-active]:flex items-center justify-center px-4 fixed inset-0 z-50 overflow-y-auto">
    <div class="fixed inset-0 bg-black/50 transition-opacity"></div>
    <section class="relative w-full max-w-4xl rounded-lg bg-white shadow-xl">
        <header class="flex items-center justify-between px-6 py-4">
            <h3 class="text-xl font-semibold text-gray-900" id="modal_title">
                {{ $title }}
            </h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="close_modal('{{ $id_modal }}')">
                <i class="fas fa-times text-xl"></i>
            </button>
        </header>
        <div class="h-px bg-gray-200 w-[90%] mx-auto"></div>

        <div class="max-h-[calc(100vh-200px)] overflow-y-auto px-6 py-4">
            {{ $slot }}
        </div>

        <div class="h-px bg-gray-200 w-[90%] mx-auto"></div>
        <footer class="flex justify-end gap-3 px-6 py-4">
            @if($id_modal === 'modal_tambah')
                <button type="submit" form="formulir-tambah-data"
                    class="cursor-pointer px-4 py-2 rounded-lg transition-colors duration-300 bg-blue-600 text-white hover:bg-blue-700">
                    Simpan
                </button>
            @elseif($id_modal === 'modal_filter')
                <button type="submit" form="formulir-filter"
                    class="cursor-pointer px-4 py-2 rounded-lg transition-colors duration-300 bg-blue-600 text-white hover:bg-blue-700">
                    Terapkan Filter
                </button>
            @endif
            <button type="button"
                class="cursor-pointer rounded-lg px-4 py-2 text-sm font-medium transition-colors duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200"
                onclick="close_modal('{{ $id_modal }}')">
                Tutup
            </button>
            {{ $footer ?? '' }}
        </footer>
    </section>
</figure>

@if($id_modal === 'modal_tambah')
<script>
document.getElementById('formulir-tambah-data').addEventListener('submit', function(e) {
    const active_tab = document.querySelector('.tab-content:not(.hidden)');
    const requiredFields = active_tab.querySelectorAll('[data-required="true"]');
    
    let isValid = true;
    requiredFields.forEach(field => {
        if (!field.value) {
            isValid = false;
            field.classList.add('border-red-500');
        } else {
            field.classList.remove('border-red-500');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Mohon lengkapi semua field yang wajib diisi');
    }
});
</script>
@endif