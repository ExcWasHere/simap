@props(['headers', 'rows', 'id_modul' => []])

<div class="w-full">
    <div class="overflow-x-auto overflow-y-auto bg-white rounded-lg shadow relative max-h-[70vh]">
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
                @foreach ($rows as $index => $row)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        @foreach ($row as $key => $cell)
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <div class="flex items-center">
                                    <div class="truncate">{{ $cell }}</div>
                                </div>
                            </td>
                        @endforeach
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
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
                                        'penindakan' => [
                                            'route' => 'penindakan.dokumen',
                                            'param' => 'no_sbp',
                                            'colors' => 'bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-700',
                                            'icon' => 'fas fa-gavel',
                                            'title' => 'Akses Modul Penindakan',
                                        ],
                                    ];
                                @endphp
                                @foreach ($modules as $module_name => $config)
                                    <a href="{{ route('dokumen.show', [
                                        'section' => $section,
                                        'id' => rawurlencode($current_id),
                                        'module_type' => $module_name
                                    ]) }}"
                                        class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 {{ $config['colors'] }}"
                                        title="{{ $config['title'] }}">
                                        <i class="{{ $config['icon'] }}"></i>
                                    </a>
                                @endforeach
                                <button
                                    class="dropdown-trigger h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 hover:bg-gray-100"
                                    data-id="{{ $current_id }}"
                                    data-menu-id="{{ $unique_menu_id }}"
                                >
                                    <i class="fas fa-ellipsis-v text-gray-500"></i>
                                </button>
                            </fieldset>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
</div>

@push('skrip')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const dropdown_triggers = document.querySelectorAll(".dropdown-trigger");
            const dropdown_menus = document.querySelectorAll(".dropdown-menu");

            document.addEventListener("click", function (event) {
                if (!event.target.closest(".dropdown-trigger") && !event.target.closest(".dropdown-menu")) {
                    dropdown_menus.forEach((menu) => menu.classList.add("hidden"));
                }
            });

            dropdown_triggers.forEach((trigger) => {
                trigger.addEventListener("click", function (e) {
                    e.stopPropagation();
                    const menuId = this.getAttribute("data-menu-id");
                    const menu = document.getElementById(menuId);

                    dropdown_menus.forEach((m) => {
                        if (m !== menu) m.classList.add("hidden");
                    });

                    const rect = trigger.getBoundingClientRect();
                    menu.style.position = "fixed";
                    menu.style.top = `${rect.bottom}px`;
                    menu.style.left = `${rect.left}px`;

                    menu.classList.toggle("hidden");
                });
            });
        })
    </script>
@endpush