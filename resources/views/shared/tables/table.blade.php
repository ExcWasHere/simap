@props(['headers', 'rows', 'id_modul' => []])

<section class="w-full overflow-x-auto overflow-y-auto bg-white rounded-lg shadow relative horizontal-scroll-table">
    <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="sticky top-0 px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                        {{ $header }}
                    </th>
                @endforeach
                <th scope="col" class="sticky top-0 px-4 sm:px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if (count($rows) > 0)
                @foreach ($rows as $index => $row)
                    <tr class="transition-colors duration-200 hover:bg-gray-50 ">
                        @foreach ($row as $key => $cell)
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 sm:px-6">
                                {{ $cell }}
                            </td>
                        @endforeach
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium sm:px-6">
                            <fieldset class="flex items-center gap-2">
                                @php
                                    $section = request()->segment(1);
                                    $current_id = $row[1];
                                    $unique_menu_id = "dropdown-menu-{$index}-{$current_id}";

                                    $modules = [
                                        'intelijen' => [
                                            'route' => 'intelijen.dokumen',
                                            'param' => 'no_nhi',
                                            'colors' => 'bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-700',
                                            'icon' => 'fas fa-file-alt',
                                            'title' => 'Akses Modul Intelijen',
                                        ],
                                        'penindakan' => [
                                            'route' => 'penindakan.dokumen',
                                            'param' => 'no_sbp',
                                            'colors' => 'bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-700',
                                            'icon' => 'fas fa-gavel',
                                            'title' => 'Akses Modul Penindakan',
                                        ],
                                        'penyidikan' => [
                                            'route' => 'penyidikan.dokumen',
                                            'param' => 'no_spdp',
                                            'colors' => 'bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-700',
                                            'icon' => 'fas fa-search',
                                            'title' => 'Akses Modul Penyidikan',
                                        ],
                                        'monitoring' => [
                                            'route' => 'monitoring.dokumen',
                                            'param' => 'id',
                                            'colors' => 'bg-purple-100 text-purple-600 hover:bg-purple-200 hover:text-purple-700',
                                            'icon' => 'fas fa-chart-line',
                                            'title' => 'Akses Modul Monitoring',
                                        ],
                                    ];
                                @endphp
                                @foreach ($modules as $module_name => $config)
                                    <a href="{{ route('dokumen.show', [
                                        'section' => $section,
                                        'id' => rawurlencode($current_id),
                                        'module_type' => $module_name,
                                    ]) }}"
                                        class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 {{ $config['colors'] }}"
                                        title="{{ $config['title'] }}">
                                        <i class="{{ $config['icon'] }}"></i>
                                    </a>
                                @endforeach
                                <span class="border-r border-gray-300 h-8"></span>
                                <button
                                    data-id="{{ $current_id }}"
                                    class="edit-btn h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-yellow-100 text-yellow-600 hover:bg-yellow-200 hover:text-yellow-700"
                                    title="Edit Data"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button
                                    data-id="{{ $current_id }}"
                                    class="delete-btn h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-red-100 text-red-600 hover:bg-red-200 hover:text-red-700"
                                    title="Hapus Data"
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </fieldset>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($headers) + 1 }}" class="space-y-3 px-4 sm:px-6 py-12 text-center">
                        <i class="fas fa-search text-xl rounded-full p-3 bg-gray-100 text-gray-400"></i>
                        <h5 class="text-gray-500 text-sm">
                            @if (request('search'))
                                Tidak ada data yang sesuai dengan pencarian "{{ request('search') }}"
                            @else
                                Tidak ada data yang tersedia.
                            @endif
                        </h5>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    @foreach ($rows as $index => $row)
        @php
            $current_id = $row[1];
            $unique_menu_id = "dropdown-menu-{$index}-{$current_id}";
        @endphp
        <div id="{{ $unique_menu_id }}" class="dropdown-menu hidden fixed mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50">
            <button data-id="{{ $current_id }}" class="edit-btn w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 flex items-center gap-2">
                <i class="fas fa-edit w-4"></i>
                Edit
            </button>
            <button data-id="{{ $current_id }}" class="delete-btn w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
                <i class="fas fa-trash-alt w-4"></i>
                Hapus
            </button>
        </div>
    @endforeach
</section>

@push('skrip')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const editButtons = document.querySelectorAll(".edit-btn");
            const deleteButtons = document.querySelectorAll(".delete-btn");

            editButtons.forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const id = this.getAttribute("data-id");
                    if (typeof window.showEditModal === 'function') {
                        window.showEditModal(id);
                    } else {
                        console.error('showEditModal tidak ditemukan');
                    }
                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const id = this.getAttribute("data-id");
                    if (typeof showDeleteConfirmation === 'function') {
                        showDeleteConfirmation(id);
                    } else {
                        console.error('Konfirmasi hapus tidak ditemukan');
                    }
                });
            });
        });

        const tables = document.querySelectorAll('.horizontal-scroll-table');

        tables.forEach(table => {
            table.addEventListener('wheel', (e) => {
                if (table.scrollWidth > table.clientWidth) {
                    e.preventDefault();
                    const delta = e.deltaY || e.detail || e.wheelDelta;
                    table.scrollLeft += (delta * 0.5);

                    if ((table.scrollLeft <= 0 && delta < 0) || (table.scrollLeft >= (table.scrollWidth -
                            table.clientWidth) && delta > 0)) {
                        e.preventDefault = false;
                    }
                }
            }, {
                passive: false
            });

            if (table.scrollWidth > table.clientWidth) table.classList.add('cursor-ew-resize');
        });
    </script>
@endpush