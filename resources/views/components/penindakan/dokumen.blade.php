@props(['documents', 'no_sbp'])

<div class="container mx-auto px-4 py-6 pt-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($documents as $document)
            <div class="relative bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <form action="{{ route('dokumen.delete', $document->id) }}" method="POST" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')" 
                        class="p-1 h-8 w-8 bg-red-100 text-red-600 rounded-full hover:bg-red-200 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </form>

                <a href="{{ asset($document->file_path) }}" class="block">
                    <div class="p-4 flex items-center justify-center h-32">
                        @if(Str::endsWith($document->file_path, '.pdf'))
                            <i class="fas fa-file-pdf text-4xl text-red-500"></i>
                        @elseif(Str::endsWith($document->file_path, ['.doc', '.docx']))
                            <i class="fas fa-file-word text-4xl text-blue-500"></i>
                        @elseif(Str::endsWith($document->file_path, ['.xls', '.xlsx']))
                            <i class="fas fa-file-excel text-4xl text-green-500"></i>
                        @else
                            <i class="fas fa-file text-4xl text-gray-500"></i>
                        @endif
                    </div>
                    <div class="p-4 bg-gray-50 rounded-b-lg">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $document->sub_tipe }}</h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($document->deskripsi, 100) }}</p>
                        <div class="mt-2 flex items-center text-xs text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            <span>{{ $document->created_at->locale('id')->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">Belum ada dokumen yang diunggah.</p>
            </div>
        @endforelse

        <a href="{{ route('penindakan.dokumen.upload', ['no_sbp' => $no_sbp]) }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="p-4 flex items-center justify-center h-32">
                <i class="fas fa-upload text-4xl text-blue-500"></i>
            </div>
            <div class="p-4 bg-gray-50 rounded-b-lg">
                <h3 class="text-lg font-semibold text-gray-900">Upload Dokumen</h3>
                <p class="text-sm text-gray-600">Unggah dokumen baru</p>
            </div>
        </a>
    </div>
</div>