@props(['documents', 'reference_id', 'section', 'module_type'])

@php
    $reference_param = match ($section) {
        'intelijen' => 'no_nhi',
        'monitoring' => 'id',
        'penindakan' => 'no_sbp',
        'penyidikan' => 'no_spdp',
        default => 'id',
    };

    $upload_route = match ($section) {
        'intelijen' => 'intelijen.upload.dokumen',
        'monitoring' => 'monitoring.upload.dokumen',
        'penindakan' => 'penindakan.upload.dokumen',
        'penyidikan' => 'penyidikan.upload.dokumen',
        default => 'dokumen.upload',
    };
@endphp

<section class="container mx-auto px-4 grid grid-cols-1 gap-x-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @forelse($documents as $document)
        <div class="group mt-10 relative bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
            <form action="{{ route('dokumen.hapus_dokumen', $document->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')"
                    class="fas fa-trash-alt p-1.5 h-10 w-10 text-sm bg-white/80 border border-gray-200 rounded-lg text-gray-400 backdrop-blur-sm transition-all duration-200 cursor-pointer hover:bg-red-50 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 group-hover:bg-red-50 group-hover:border-red-200 group-hover:text-red-500"
                >
                </button>
            </form>
            <a href="{{ route('dokumen.unduh_dokumen', $document->id) }}" class="block group-hover:scale-[0.99] transition-transform duration-200">
                <div class="p-6 flex flex-col items-center justify-center h-40 space-y-3">
                    @if (Str::endsWith($document->file_path, '.pdf'))
                        <span class="relative">
                            <i class="fas fa-file-pdf text-5xl text-red-500/90 group-hover:text-red-600 transition-colors duration-200"></i>
                            <i class="fas fa-download text-[10px] text-red-500 absolute -bottom-1 -right-1 p-1 bg-red-100 rounded-full flex items-center justify-center"></i>
                        </span>
                    @elseif(Str::endsWith($document->file_path, ['.doc', '.docx']))
                        <span class="relative">
                            <i class="fas fa-file-word text-5xl text-blue-500/90 group-hover:text-blue-600 transition-colors duration-200"></i>
                            <i class="fas fa-download absolute -right-1 -bottom-1 flex items-center justify-center p-1 text-[10px] text-blue-500 bg-blue-100 rounded-full"></i>
                        </span>
                    @elseif(Str::endsWith($document->file_path, ['.xls', '.xlsx']))
                        <span class="relative">
                            <i class="fas fa-file-excel text-5xl text-green-500/90 group-hover:text-green-600 transition-colors duration-200"></i>
                            <i class="fas fa-download text-[10px] text-green-500 absolute -bottom-1 -right-1 p-1 bg-green-100 rounded-full flex items-center justify-center"></i>
                        </span>
                    @else
                        <span class="relative">
                            <i class="fas fa-file text-5xl text-gray-500/90 group-hover:text-gray-600 transition-colors duration-200"></i>
                            <i class="fas fa-download text-[10px] text-gray-500 absolute -bottom-1 -right-1 p-1 bg-gray-100 rounded-full flex items-center justify-center"></i>
                        </span>
                    @endif
                </div>
                <div class="p-4 bg-gray-50/50 rounded-b-xl border-t border-gray-100">
                    <h3 class="text-base font-medium text-gray-700">{{ $document->tipe }}</h3>
                    @if ($document->deskripsi)
                        <h5 class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $document->deskripsi }}</h5>
                    @endif
                    <address class="mt-3 flex items-center text-xs text-gray-500">
                        <i class="fas fa-history mr-1.5"></i>
                        <h5>{{ $document->created_at->locale('id')->diffForHumans() }}</h5>
                    </address>
                </div>
            </a>
        </div>
    @empty
        <span class="col-span-full cursor-default flex flex-col items-center justify-center py-24 px-4 text-center space-y-3">
            <i class="fas fa-folder-open text-4xl text-gray-300"></i>
            <h5 class="text-gray-500 text-lg">Belum ada dokumen yang diunggah.</h5>
        </span>
    @endforelse
    <figure
        class="group mt-10 relative bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl border-2 border-dashed border-blue-200 hover:border-blue-300 transition-all duration-300 cursor-pointer"
        onclick="window.dispatchEvent(new CustomEvent('open-upload-modal'))"
    >
        <span class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/[0.02] rounded-xl transition-colors duration-300"></span>
        <div class="relative p-6 flex flex-col items-center justify-center h-40 space-y-3">
            <i class="fas fa-cloud-upload-alt text-5xl text-blue-500/90 group-hover:text-blue-600 transition-colors duration-200"></i>
            <i class="fas fa-plus text-[10px] text-blue-500 absolute top-1/2 right-3/8 p-1 bg-blue-100 rounded-full flex items-center justify-center"></i>
        </div>
        <figcaption class="p-4 bg-white/50 rounded-b-xl border-t border-blue-100">
            <h3 class="text-lg font-medium text-blue-600 group-hover:text-blue-700 transition-colors duration-200">
                Unggah Dokumen
            </h3>
            <h6 class="mt-1 italic text-sm text-blue-500/80">
                Cari dokumen yang perlu diunggah.
            </h6>
        </figcaption>
    </figure>
</section>

@include('components.unggah-dokumen.main', [
    'reference_id' => $reference_id,
    'section' => $section,
    'module_type' => $module_type,
])