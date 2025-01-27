<section class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                @foreach ($headers as $header)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $header }}
                    </th>
                @endforeach
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if(count($rows) > 0)
                @foreach ($rows as $row)
                    <tr class="hover:bg-gray-50">
                        @foreach ($row as $cell)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $cell }}
                            </td>
                        @endforeach
                        <td class="flex items-center justify-center gap-2 px-6 py-4 text-sm text-gray-900">
                            <a
                                href="/intelijen/dokumen"
                                class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-700"
                                title="Akses Modul Intelijen"
                            >
                                <i class="fas fa-file-alt"></i>
                            </a>
                            <a
                                href="/penyidikan/dokumen"
                                class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-700"
                                title="Akses Modul Penyidikan"
                            >
                                <i class="fas fa-search"></i>
                            </a>
                            <a
                                href="/monitoring-bhp/dokumen"
                                class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-purple-100 text-purple-600 hover:bg-purple-200 hover:text-purple-700"
                                title="Akses Modul Monitoring"
                            >
                                <i class="fas fa-chart-line"></i>
                            </a>
                            <a
                                href="/penindakan/dokumen"
                                class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-700"
                                title="Akses Modul Penindakan"
                            >
                                <i class="fas fa-gavel"></i>
                            </a>
                            <button
                                onclick="open_modal('modal_detail')"
                                class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-yellow-100 text-yellow-600 hover:bg-yellow-200 hover:text-yellow-700"
                                title="Lihat Detail"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($headers) + 1 }}" class="px-6 py-8 text-center text-sm text-gray-500">
                        Data Kosong
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</section>