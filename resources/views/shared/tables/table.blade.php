@props(['headers', 'rows'])

<div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
        <thead>
            <tr class="text-left">
                @foreach($headers as $header)
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
            @foreach($rows as $row)
                <tr>
                    @foreach($row as $key => $cell)
                        <td class="border-dashed border-t border-gray-200 px-6 py-4 text-gray-700">
                            {{ $cell }}
                        </td>
                    @endforeach
                    <td class="border-dashed border-t border-gray-200 px-6 py-4">
                        <div class="flex items-center gap-2">
                            @php
                                $section = request()->segment(1);
                                $currentId = $row[1];
                                
                                $modules = [
                                    'intelijen' => [
                                        'route' => 'intelijen.dokumen',
                                        'param' => 'no_nhi',
                                        'colors' => 'bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-700',
                                        'icon' => 'fas fa-file-alt',
                                        'title' => 'Akses Modul Intelijen'
                                    ],
                                    'penyidikan' => [
                                        'route' => 'penyidikan.dokumen',
                                        'param' => 'no_spdp',
                                        'colors' => 'bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-700',
                                        'icon' => 'fas fa-search',
                                        'title' => 'Akses Modul Penyidikan'
                                    ],
                                    'monitoring' => [
                                        'route' => 'monitoring.dokumen',
                                        'param' => 'id',
                                        'colors' => 'bg-purple-100 text-purple-600 hover:bg-purple-200 hover:text-purple-700',
                                        'icon' => 'fas fa-chart-line',
                                        'title' => 'Akses Modul Monitoring'
                                    ],
                                    'penindakan' => [
                                        'route' => 'penindakan.dokumen',
                                        'param' => 'no_sbp',
                                        'colors' => 'bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-700',
                                        'icon' => 'fas fa-gavel',
                                        'title' => 'Akses Modul Penindakan'
                                    ]
                                ];
                            @endphp

                            @foreach($modules as $moduleName => $config)
                                <a href="{{ route($config['route'], [$config['param'] => $currentId]) }}"
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 {{ $config['colors'] }}"
                                    title="{{ $section === $moduleName ? str_replace('Modul', 'Dokumen', $config['title']) : $config['title'] }}">
                                    <i class="{{ $config['icon'] }}"></i>
                                </a>
                            @endforeach

                            <div class="relative dropdown-container">
                                <button class="dropdown-trigger h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 hover:bg-gray-100">
                                    <i class="fas fa-ellipsis-v text-gray-500"></i>
                                </button>

                                <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <button data-id="{{ $currentId }}" 
                                                class="edit-btn w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 flex items-center gap-2">
                                            <i class="fas fa-edit w-4"></i>
                                            Edit
                                        </button>
                                        <button data-id="{{ $currentId }}" 
                                                class="delete-btn w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 flex items-center gap-2">
                                            <i class="fas fa-trash-alt w-4"></i>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-container')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });

        document.querySelectorAll('.dropdown-trigger').forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                const menu = this.nextElementSibling;
                
                document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                    if (otherMenu !== menu) {
                        otherMenu.classList.add('hidden');
                    }
                });

                menu.classList.toggle('hidden');
            });
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                console.log('Edit item with ID:', id);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const section = window.location.pathname.split('/')[1];
                
                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    this.innerHTML = '<i class="fas fa-spinner fa-spin w-4"></i> Menghapus...';
                    this.disabled = true;
                    
                    fetch(`/${section}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const row = this.closest('tr');
                            row.style.backgroundColor = '#fee2e2';
                            row.style.transition = 'background-color 0.5s ease';
                            
                            setTimeout(() => {
                                row.style.opacity = '0';
                                row.style.transition = 'opacity 0.5s ease';
                                
                                setTimeout(() => {
                                    row.remove();
                                    
                                    const notification = document.createElement('div');
                                    notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0';
                                    notification.innerHTML = '<div class="flex items-center gap-2"><i class="fas fa-check-circle"></i> Data berhasil dihapus</div>';
                                    document.body.appendChild(notification);
                                    
                                    setTimeout(() => {
                                        notification.style.opacity = '0';
                                        setTimeout(() => notification.remove(), 500);
                                    }, 3000);
                                }, 500);
                            }, 100);
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan saat menghapus data');
                        }
                    })
                    .catch(error => {
                        this.innerHTML = '<i class="fas fa-trash-alt w-4"></i> Hapus';
                        this.disabled = false;
                        
                        const notification = document.createElement('div');
                        notification.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0';
                        notification.innerHTML = `<div class="flex items-center gap-2"><i class="fas fa-exclamation-circle"></i> ${error.message}</div>`;
                        document.body.appendChild(notification);
                        
                        setTimeout(() => {
                            notification.style.opacity = '0';
                            setTimeout(() => notification.remove(), 500);
                        }, 3000);
                    });
                }
            });
        });
    });
</script>
@endpush