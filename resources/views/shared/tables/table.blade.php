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
                                
                                $intelijenId = match($section) {
                                    'intelijen' => $currentId,
                                    'penyidikan', 'penindakan', 'monitoring' => $row[1],
                                    default => null
                                };
                            @endphp
    
                            @if($section === 'intelijen')
                                <a href="{{ route('intelijen.dokumen', ['no_nhi' => $currentId]) }}" 
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-700"
                                    title="Akses Dokumen Intelijen">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            @elseif($intelijenId)
                                <a href="{{ route('intelijen.dokumen', ['no_nhi' => $intelijenId]) }}"
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-blue-100 text-blue-600 hover:bg-blue-200 hover:text-blue-700"
                                    title="Akses Modul Intelijen">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            @endif

                            @if($section === 'penyidikan')
                                <a href="{{ route('penyidikan.dokumen', ['no_spdp' => $currentId]) }}" 
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-700"
                                    title="Akses Dokumen Penyidikan">
                                    <i class="fas fa-search"></i>
                                </a>
                            @elseif($section !== 'penyidikan')
                                <a href="{{ route('penyidikan.dokumen', ['no_spdp' => $currentId]) }}"
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-green-100 text-green-600 hover:bg-green-200 hover:text-green-700"
                                    title="Akses Modul Penyidikan">
                                    <i class="fas fa-search"></i>
                                </a>
                            @endif

                            @if($section === 'monitoring')
                                <a href="{{ route('monitoring.dokumen', ['id' => $currentId]) }}" 
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-purple-100 text-purple-600 hover:bg-purple-200 hover:text-purple-700"
                                    title="Akses Dokumen Monitoring">
                                    <i class="fas fa-chart-line"></i>
                                </a>
                            @elseif($section !== 'monitoring')
                                <a href="{{ route('monitoring.dokumen', ['id' => $currentId]) }}"
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-purple-100 text-purple-600 hover:bg-purple-200 hover:text-purple-700"
                                    title="Akses Modul Monitoring">
                                    <i class="fas fa-chart-line"></i>
                                </a>
                            @endif

                            @if($section === 'penindakan')
                                <a href="{{ route('penindakan.dokumen', ['no_sbp' => $currentId]) }}" 
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-700"
                                    title="Akses Dokumen Penindakan">
                                    <i class="fas fa-gavel"></i>
                                </a>
                            @elseif($section !== 'penindakan')
                                <a href="{{ route('penindakan.dokumen', ['no_sbp' => $currentId]) }}"
                                    class="h-8 w-8 cursor-pointer flex items-center justify-center rounded-lg transition-colors duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-700"
                                    title="Akses Modul Penindakan">
                                    <i class="fas fa-gavel"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>