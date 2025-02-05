@props(['headers', 'rows', 'id_modul' => []])

<div class="relative">
    <section class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
                <tr class="text-left">
                    @foreach ($headers as $header)
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            {{ $header }}
                        </th>
                    @endforeach
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $index => $row)
                    <tr>
                        @foreach ($row as $key => $cell)
                            <td class="border-dashed border-t border-gray-200 px-6 py-4 text-gray-700">
                                {{ $cell }}
                            </td>
                        @endforeach
                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                            <fieldset class="flex items-center gap-2">
                                @php
                                    $section = request()->segment(1);
                                    $current_id = $row[1];

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
                                    <a
                                        href="{{ route('dokumen.show', ['section' => $section, 'id' => $current_id, 'module_type' => $module_name]) }}"
                                        class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 {{ $config['colors'] }}"
                                        title="{{ $config['title'] }}"
                                    >
                                        <i class="{{ $config['icon'] }}"></i>
                                    </a>
                                @endforeach

                                <button 
                                    class="dropdown-trigger h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 hover:bg-gray-100"
                                    data-id="{{ $current_id }}"
                                >
                                    <i class="fas fa-ellipsis-v text-gray-500"></i>
                                </button>
                            </fieldset>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <div id="dropdown-menu-{{ $current_id ?? '' }}" class="dropdown-menu hidden fixed mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50">
        <button data-id="{{ $current_id ?? '' }}" class="edit-btn w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 flex items-center gap-2">
            <i class="fas fa-edit w-4"></i>
            Edit
        </button>
        <button data-id="{{ $current_id ?? '' }}" class="delete-btn w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
            <i class="fas fa-trash-alt w-4"></i>
            Hapus
        </button>
    </div>
</div>

@push('skrip')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');

    function closeAllDropdowns() {
        dropdownMenus.forEach(menu => menu.classList.add('hidden'));
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown-trigger') && !event.target.closest('.dropdown-menu')) {
            closeAllDropdowns();
        }
    });

    dropdownTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = this.getAttribute('data-id');
            const menu = document.getElementById(`dropdown-menu-${id}`);
            
            dropdownMenus.forEach(m => {
                if (m !== menu) {
                    m.classList.add('hidden');
                }
            });

            const rect = trigger.getBoundingClientRect();
            menu.style.position = 'fixed';
            menu.style.top = `${rect.bottom + window.scrollY}px`;
            menu.style.left = `${rect.left}px`;
            
            menu.classList.toggle('hidden');
        });
    });
});
</script>
@endpush