<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                @foreach($headers as $header)
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
            @foreach($rows as $row)
                <tr class="hover:bg-gray-50">
                    @foreach($row as $cell)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $cell }}
                        </td>
                    @endforeach
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="flex gap-2">
                            <a href="/intelijen/document" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-700 transition-colors duration-200" 
                               title="Akses Modul Intelijen">
                                <i class="fas fa-file-alt"></i>
                            </a>
                            <a href="/penyidikan/document" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-700 transition-colors duration-200" 
                               title="Akses Modul Penyidikan">
                                <i class="fas fa-search"></i>
                            </a>
                            <a href="/monitoring/document" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-purple-100 text-purple-600 hover:bg-purple-200 hover:text-purple-700 transition-colors duration-200" 
                               title="Akses Modul Monitoring">
                                <i class="fas fa-chart-line"></i>
                            </a>
                            <a href="/penindakan/document" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-700 transition-colors duration-200" 
                               title="Akses Modul Penindakan">
                                <i class="fas fa-gavel"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 