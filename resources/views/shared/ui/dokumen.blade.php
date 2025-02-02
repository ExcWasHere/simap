@props(['documents', 'reference_id', 'section'])

@php
    $reference_param = match($section) {
        'intelijen' => 'no_nhi',
        'monitoring' => 'id',
        'penindakan' => 'no_sbp',
        'penyidikan' => 'no_spdp',
        default => 'id'
    };

    $uploadRoute = match($section) {
        'intelijen' => 'intelijen.dokumen.upload',
        'monitoring' => 'monitoring.dokumen.upload',
        'penindakan' => 'penindakan.dokumen.upload',
        'penyidikan' => 'penyidikan.dokumen.upload',
        default => 'dokumen.upload'
    };
@endphp

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($documents as $document)
            <div class="group relative bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <form action="{{ route('dokumen.delete', $document->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')" 
                        class="p-1.5 h-10 w-10 bg-white/80 backdrop-blur-sm text-gray-400 rounded-lg 
                               hover:bg-red-50 hover:text-red-500 

                               focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 
                               transition-all duration-200 group-hover:bg-red-50 group-hover:text-red-500
                               border border-gray-200 group-hover:border-red-200">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                </form>

                <a href="{{ asset($document->file_path) }}" class="block group-hover:scale-[0.99] transition-transform duration-200">
                    <div class="p-6 flex flex-col items-center justify-center h-40 space-y-3">
                        @if(Str::endsWith($document->file_path, '.pdf'))
                            <div class="relative">
                                <i class="fas fa-file-pdf text-5xl text-red-500/90 group-hover:text-red-600 transition-colors duration-200"></i>
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-download text-[10px] text-red-500"></i>
                                </div>
                            </div>
                        @elseif(Str::endsWith($document->file_path, ['.doc', '.docx']))
                            <div class="relative">
                                <i class="fas fa-file-word text-5xl text-blue-500/90 group-hover:text-blue-600 transition-colors duration-200"></i>
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-download text-[10px] text-blue-500"></i>
                                </div>
                            </div>
                        @elseif(Str::endsWith($document->file_path, ['.xls', '.xlsx']))
                            <div class="relative">
                                <i class="fas fa-file-excel text-5xl text-green-500/90 group-hover:text-green-600 transition-colors duration-200"></i>
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-download text-[10px] text-green-500"></i>
                                </div>
                            </div>
                        @else
                            <div class="relative">
                                <i class="fas fa-file text-5xl text-gray-500/90 group-hover:text-gray-600 transition-colors duration-200"></i>
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-download text-[10px] text-gray-500"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 bg-gray-50/50 rounded-b-xl border-t border-gray-100">
                        <h3 class="text-lg font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200">{{ $document->sub_tipe }}</h3>
                        <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $document->deskripsi }}</p>
                        <div class="mt-3 flex items-center text-xs text-gray-500">
                            <i class="fas fa-history mr-1.5"></i>
                            <span>{{ $document->created_at->locale('id')->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-12 px-4">
                <div class="text-center space-y-3">
                    <i class="fas fa-folder-open text-4xl text-gray-300"></i>
                    <p class="text-gray-500 text-lg">Belum ada dokumen yang diunggah.</p>
                </div>
            </div>
        @endforelse

        <a href="{{ route($uploadRoute, [$reference_param => $reference_id]) }}" 
           class="group relative bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl border-2 border-dashed border-blue-200 hover:border-blue-300 transition-all duration-300">
            <div class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/[0.02] rounded-xl transition-colors duration-300"></div>
            <div class="p-6 flex flex-col items-center justify-center h-40 space-y-3">
                <div class="relative">
                    <i class="fas fa-cloud-upload-alt text-5xl text-blue-500/90 group-hover:text-blue-600 transition-colors duration-200"></i>
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-plus text-[10px] text-blue-500"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white/50 rounded-b-xl border-t border-blue-100">
                <h3 class="text-lg font-medium text-blue-600 group-hover:text-blue-700 transition-colors duration-200">Upload Dokumen</h3>
                <p class="mt-1 text-sm text-blue-500/80">Unggah dokumen baru</p>
            </div>
        </a>
    </div>
</div> 