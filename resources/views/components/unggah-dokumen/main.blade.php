<div class="min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-2xl font-semibold text-gray-800">Upload Dokumen Baru</h2>
                <p class="mt-1 text-sm text-gray-500">Unggah dokumen PDF untuk melengkapi data</p>
            </div>

            @if(session('success'))
                <div class="mx-8 mt-6">
                    <div class="rounded-lg bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mx-8 mt-6">
                    <div class="rounded-lg bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @php
                $currentSection = request()->segment(1) ?: 'intelijen';
                
                $referenceParam = match($currentSection) {
                    'intelijen' => 'no_nhi',
                    'monitoring' => 'id',
                    'penindakan' => 'no_sbp',
                    'penyidikan' => 'no_spdp',
                    default => null
                };
                
                $referenceId = $reference_id ?? request()->query($referenceParam);
                
                $uploadRoute = match($currentSection) {
                    'intelijen' => 'intelijen.upload.dokumen',
                    'monitoring' => 'monitoring.upload.dokumen',
                    'penindakan' => 'penindakan.upload.dokumen',
                    'penyidikan' => 'penyidikan.upload.dokumen',
                    default => 'intelijen.upload.dokumen'
                };
            @endphp

            <form action="{{ route($uploadRoute, [$referenceParam => $referenceId]) }}" method="POST" enctype="multipart/form-data" class="space-y-8 px-8 py-6">
                @csrf
                <input type="hidden" name="tipe" value="{{ $currentSection }}">
                
                <div class="space-y-2">
                    <label for="tipe" class="block text-sm font-medium text-gray-700">
                        Tipe Dokumen
                    </label>
                    <select name="sub_tipe" id="tipe"
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                        <option value="">Pilih Tipe Dokumen</option>

                        @switch($currentSection)
                            @case('intelijen')
                                <option value="ST-I">ST-I</option>
                                <option value="LPTI">LPTI</option>
                                <option value="LPPI">LPPI</option>
                                <option value="LKAI">LKAI</option>
                                <option value="NHI">NHI</option>
                                <option value="NI">NI</option>
                                @break

                            @case('penyidikan')
                                <option value="LK">LK</option>
                                <option value="SPTP">SPTP</option>
                                <option value="SPDP">SPDP</option>
                                <option value="TAP SITA">TAP SITA</option>
                                <option value="P2I">P2I</option>
                                @break

                            @case('monitoring')
                                <option value="KEP-BDN">KEP-BDN</option>
                                <option value="KEP-BMN">KEP-BMN</option>
                                <option value="KEP-UR">KEP-UR</option>
                                <option value="STCK">STCK</option>
                                @break

                            @case('penindakan')
                                <option value="PRIN">PRIN</option>
                                <option value="ST">ST</option>
                                <option value="BA-Pemeriksaan">BA-Pemeriksaan</option>
                                <option value="BA-Penegahan">BA-Penegahan</option>
                                <option value="BAST">BAST</option>
                                <option value="BA-Dokumentasi">BA-Dokumentasi</option>
                                <option value="BA-Pencacahan">BA-Pencacahan</option>
                                <option value="BA-Penyegelan">BA-Penyegelan</option>
                                <option value="SBP">SBP</option>
                                <option value="LPHP">LPHP</option>
                                <option value="LP/LP1">LP/LP1</option>
                                <option value="LPP">LPP</option>
                                <option value="LPF">LPF</option>
                                <option value="SPLIT">SPLIT</option>
                                <option value="LHP">LHP</option>
                                <option value="LRP">LRP</option>
                                @break
                        @endswitch
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        placeholder="Masukkan deskripsi dokumen"></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Upload File PDF
                    </label>
                    <div class="mt-1 flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 relative" id="dropZone">
                        <div class="space-y-1 text-center" id="uploadState">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="file" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload file</span>
                                    <input id="file" name="file" type="file" class="sr-only" accept=".pdf" required>
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF hingga 10MB</p>
                        </div>

                        <div id="selectedFileState" class="hidden w-full">
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <i class="fa-solid fa-file-pdf text-red-500 text-2xl"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p id="selected-file" class="text-sm font-medium text-gray-900 truncate"></p>
                                        <p id="file-size" class="text-sm text-gray-500"></p>
                                    </div>
                                </div>
                                <button type="button" id="removeFile" class="inline-flex items-center rounded-full border border-gray-200 p-1 text-gray-400 hover:bg-gray-50 hover:text-gray-500">
                                    <span class="sr-only">Remove file</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div id="upload-progress" class="hidden mt-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Upload Progress</span>
                                    <span id="progress-percentage">0%</span>
                                </div>
                                <div class="overflow-hidden rounded-full bg-gray-200">
                                    <div id="progress-bar" class="h-2 rounded-full bg-blue-600 transition-all duration-300" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>

                        <div id="dragOverState" class="hidden absolute inset-0 backdrop-blur-sm bg-blue-50/90 rounded-lg border-2 border-blue-500">
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center">
                                    <i class="fa-solid fa-file-arrow-down text-blue-500 text-4xl mb-2"></i>
                                    <p class="text-blue-600 font-medium">Lepaskan file untuk mengunggah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end border-t border-gray-100 pt-6">
                    <button id="upload-button" type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="button-text">Upload Dokumen</span>
                        <svg id="loading-spinner" class="hidden animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file');
    const selectedFile = document.getElementById('selected-file');
    const dropZone = fileInput.closest('.border-dashed');
    const tipeSelect = document.getElementById('tipe');
    const uploadButton = document.getElementById('upload-button');
    const buttonText = document.getElementById('button-text');
    const loadingSpinner = document.getElementById('loading-spinner');
    const uploadState = document.getElementById('uploadState');
    const selectedFileState = document.getElementById('selectedFileState');
    const dragOverState = document.getElementById('dragOverState');
    const removeFileButton = document.getElementById('removeFile');
    const fileSizeElement = document.getElementById('file-size');
    const uploadProgress = document.getElementById('upload-progress');
    const progressBar = document.getElementById('progress-bar');
    const progressPercentage = document.getElementById('progress-percentage');

    const currentPath = window.location.pathname;
    const section = currentPath.split('/')[1] || 'intelijen';

    function setUploadingState(isUploading) {
        uploadButton.disabled = isUploading;
        buttonText.textContent = isUploading ? 'Mengunggah...' : 'Upload Dokumen';
        loadingSpinner.classList.toggle('hidden', !isUploading);
        uploadButton.classList.toggle('opacity-75', isUploading);
        uploadButton.classList.toggle('cursor-not-allowed', isUploading);
        
        if (isUploading) {
            uploadProgress.classList.remove('hidden');
        } else {
            uploadProgress.classList.add('hidden');
            progressBar.style.width = '0%';
            progressPercentage.textContent = '0%';
        }
    }

    function showUploadError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 fixed top-4 right-4 z-50';
        errorDiv.innerHTML = `
            <strong class="font-bold">Error!</strong>
            <p class="block">${message}</p>
        `;
        document.body.appendChild(errorDiv);
        setTimeout(() => errorDiv.remove(), 5000);
    }

    function showUploadSuccess(message) {
        const successDiv = document.createElement('div');
        successDiv.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 fixed top-4 right-4 z-50';
        successDiv.innerHTML = `
            <strong class="font-bold">Berhasil!</strong>
            <p class="block">${message}</p>
        `;
        document.body.appendChild(successDiv);
        setTimeout(() => {
            successDiv.remove();
            window.location.reload();
        }, 2000);
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function showUploadState() {
        uploadState.classList.remove('hidden');
        selectedFileState.classList.add('hidden');
    }

    function showSelectedFileState() {
        uploadState.classList.add('hidden');
        selectedFileState.classList.remove('hidden');
    }

    function updateFileName(file) {
        if (file) {
            if (file.type !== 'application/pdf') {
                showUploadError('Hanya file PDF yang diperbolehkan');
                fileInput.value = '';
                showUploadState();
                return;
            }
            
            if (file.size > 10 * 1024 * 1024) { 
                showUploadError('Ukuran file tidak boleh lebih dari 10MB');
                fileInput.value = '';
                showUploadState();
                return;
            }

            selectedFile.textContent = file.name;
            fileSizeElement.textContent = formatFileSize(file.size);
            showSelectedFileState();
        } else {
            showUploadState();
        }
    }

    removeFileButton.addEventListener('click', function() {
        fileInput.value = '';
        showUploadState();
    });

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dragOverState.classList.remove('hidden');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dragOverState.classList.add('hidden');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dragOverState.classList.add('hidden');
        
        const files = e.dataTransfer.files;
        if (files.length) {
            fileInput.files = files;
            updateFileName(files[0]);
        }
    });

    fileInput.addEventListener('change', function(e) {
        updateFileName(this.files[0]);
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!fileInput.files.length) {
            showUploadError('Silakan pilih file PDF terlebih dahulu');
            return;
        }

        const formData = new FormData(this);
        setUploadingState(true);
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const reader = response.body.getReader();
            const contentLength = +response.headers.get('Content-Length');

            let receivedLength = 0;
            while(true) {
                const {done, value} = await reader.read();

                if (done) {
                    break;
                }

                receivedLength += value.length;
                const percent = Math.round((receivedLength / contentLength) * 100);
                progressBar.style.width = percent + '%';
                progressPercentage.textContent = percent + '%';
            }

            if (response.ok) {
                showUploadSuccess('File berhasil diunggah!');
            } else {
                const data = await response.json();
                showUploadError(data.message || 'Terjadi kesalahan saat mengunggah file.');
            }
        } catch (error) {
            console.error('Upload error:', error);
            showUploadError('Terjadi kesalahan saat mengunggah file.');
        } finally {
            setUploadingState(false);
        }
    });
});
</script>