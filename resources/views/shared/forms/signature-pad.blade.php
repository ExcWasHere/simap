<div class="col-span-6 mt-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
    </label>
    <div class="mt-2">
        <div class="rounded-lg p-4 bg-white shadow-sm border border-gray-200">
            <div class="mb-3 flex justify-between items-center border-b pb-3">
                <div class="flex space-x-2">
                    <button type="button" id="draw-tab-{{ $index }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Draw Signature
                    </button>
                    <button type="button" id="upload-tab-{{ $index }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Upload Image
                    </button>
                </div>
                <button type="button" id="clear-signature-{{ $index }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Clear
                </button>
            </div>

            <div id="signature-pad-wrapper-{{ $index }}" class="relative">
                <div class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                    <canvas id="signature-pad-{{ $index }}" class="w-full h-64 cursor-crosshair"></canvas>
                </div>
                <div class="absolute bottom-2 left-2 text-xs text-gray-500">
                    Click and drag to sign
                </div>
            </div>

            <div id="signature-upload-wrapper-{{ $index }}" class="hidden">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" id="signature-upload-{{ $index }}" accept="image/*" class="hidden"
                        onchange="handleSignatureUpload(this, '{{ $index }}')">
                    <label for="signature-upload-{{ $index }}" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="mt-1 text-sm text-gray-600">
                            <span class="font-medium text-blue-600 hover:text-blue-500">Click to upload</span>
                            or drag and drop
                        </p>
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    </label>
                </div>
                <div id="file-indicator-{{ $index }}" class="mt-3"></div>
                <div id="preview-wrapper-{{ $index }}" class="hidden mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                    <div class="border rounded-lg p-2 bg-white">
                        <img id="preview-image-{{ $index }}" class="max-h-48 mx-auto" />
                    </div>
                </div>
            </div>

            <input type="hidden" name="{{ $name }}" id="signature-input-{{ $index }}">
        </div>
    </div>
</div>

@push('skrip')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        let signaturePads = {};
        let signatureCanvases = {};

        document.addEventListener('DOMContentLoaded', function() {
            initializeAllSignaturePads();
        });

        function initializeAllSignaturePads() {
            document.querySelectorAll('[id^="signature-pad-"]').forEach(canvas => {
                const index = canvas.id.split('-').pop();
                initSignaturePad(index);
                initializeTabEvents(index);
            });
        }

        function initSignaturePad(index) {
            const canvas = document.getElementById(`signature-pad-${index}`);
            if (!canvas) return;

            signatureCanvases[index] = canvas;
            
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(0, 0, 0)',
                minWidth: 1,
                maxWidth: 2.5
            });

            signaturePads[index] = signaturePad;
            
            signaturePad.addEventListener("endStroke", () => {
                saveSignature(index);
            });

            resizeCanvas(index);

            const clearButton = document.getElementById(`clear-signature-${index}`);
            if (clearButton) {
                clearButton.addEventListener('click', () => {
                    signaturePad.clear();
                    document.getElementById(`signature-input-${index}`).value = '';
                    
                    const fileInput = document.getElementById(`signature-upload-${index}`);
                    if (fileInput) fileInput.value = '';
                    
                    const uploadWrapper = document.getElementById(`signature-upload-wrapper-${index}`);
                    if (uploadWrapper) {
                        uploadWrapper.innerHTML = `
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <input type="file" id="signature-upload-${index}" accept="image/*" class="hidden"
                                    onchange="handleSignatureUpload(this, '${index}')">
                                <label for="signature-upload-${index}" class="cursor-pointer">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">
                                        <span class="font-medium text-blue-600 hover:text-blue-500">Click to upload</span>
                                        or drag and drop
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                </label>
                            </div>
                        `;
                    }
                });
            }

            window.addEventListener('resize', () => resizeCanvas(index));

            return signaturePad;
        }

        function resizeCanvas(index) {
            const canvas = signatureCanvases[index];
            if (!canvas) return;

            const wrapper = canvas.parentElement;
            const oldWidth = canvas.width;
            const oldHeight = canvas.height;
            
            canvas.width = wrapper.clientWidth;
            canvas.height = wrapper.clientHeight;

            const ctx = canvas.getContext('2d');
            ctx.fillStyle = 'rgb(248, 250, 252)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            const input = document.getElementById(`signature-input-${index}`);
            if (input && input.value) {
                const img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
                img.src = input.value;
            }
        }

        function setSignatureData(index, signatureData) {
            if (!signatureData) return;
            
            if (!signaturePads[index]) {
                initSignaturePad(index);
            }

            const canvas = signatureCanvases[index];
            const signaturePad = signaturePads[index];
            
            if (!canvas || !signaturePad) return;

            const img = new Image();
            img.onload = function() {
                const ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = 'rgb(248, 250, 252)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                signaturePad._isEmpty = false;
                
                const input = document.getElementById(`signature-input-${index}`);
                if (input) input.value = signatureData;
            };
            img.src = signatureData;
        }

        function initializeTabEvents(index) {
            const drawTab = document.getElementById(`draw-tab-${index}`);
            const uploadTab = document.getElementById(`upload-tab-${index}`);
            const padWrapper = document.getElementById(`signature-pad-wrapper-${index}`);
            const uploadWrapper = document.getElementById(`signature-upload-wrapper-${index}`);

            drawTab.addEventListener('click', () => {
                drawTab.classList.replace('bg-gray-100', 'text-blue-600');
                drawTab.classList.replace('bg-gray-600', 'text-blue-600');
                uploadTab.classList.replace('bg-blue-100', 'bg-gray-100');
                uploadTab.classList.replace('text-blue-600', 'text-gray-600');
                padWrapper.classList.remove('hidden');
                uploadWrapper.classList.add('hidden');
            });

            uploadTab.addEventListener('click', () => {
                uploadTab.classList.replace('bg-gray-100', 'text-blue-600');
                uploadTab.classList.replace('bg-gray-600', 'text-blue-600');
                drawTab.classList.replace('bg-blue-100', 'bg-gray-100');
                drawTab.classList.replace('text-blue-600', 'text-gray-600');
                uploadWrapper.classList.remove('hidden');
                padWrapper.classList.add('hidden');
            });

            if (signaturePads[index]) {
                signaturePads[index].addEventListener('endStroke', () => {
                    saveSignature(index);
                })
            }
        }

        function handleSignatureUpload(input, index) {
            const file = input.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('File yang diunggah harus berupa gambar.');
                input.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file tidak boleh melebihi 2 MB.');
                input.value = '';
                return;
            }

            const uploadWrapper = document.getElementById(`signature-upload-wrapper-${index}`);
            const uploadLabel = document.querySelector(`label[for="signature-upload-${index}"]`);
            if (!uploadWrapper || !uploadLabel) {
                console.error(`Upload wrapper or label not found for index ${index}`);
                return;
            }

            uploadLabel.style.display = 'none';

            const reader = new FileReader();
            reader.onload = function(e) {
                const signatureInput = document.getElementById(`signature-input-${index}`);
                if (signatureInput) signatureInput.value = e.target.result;

                uploadWrapper.innerHTML = `
                    <div class="border rounded-lg p-2 bg-white">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm text-blue-700">${file.name}</span>
                                <span class="text-xs text-blue-500">(${formatFileSize(file.size)})</span>
                            </div>
                        </div>
                        <img src="${e.target.result}" class="max-h-48 mx-auto" alt="Uploaded signature" />
                    </div>
                `;

                const img = new Image();
                img.onload = function() {
                    const canvas = document.getElementById(`signature-pad-${index}`);
                    if (!canvas) return;

                    const ctx = canvas.getContext('2d');
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    const scale = Math.min(
                        canvas.width / img.width,
                        canvas.height / img.height
                    );

                    const x = (canvas.width - img.width * scale) / 2;
                    const y = (canvas.height - img.height * scale) / 2;

                    ctx.drawImage(img, x, y, img.width * scale, img.height * scale);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function createFileIndicator(index) {
            const uploadWrapper = document.getElementById(`signature-upload-wrapper-${index}`);
            const fileIndicator = document.createElement('div');
            fileIndicator.id = `file-indicator-${index}`;
            fileIndicator.className = 'mt-3';
            uploadWrapper.insertBefore(fileIndicator, document.getElementById(`preview-wrapper-${index}`));
            return fileIndicator;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function saveSignature(index) {
            const signaturePad = signaturePads[index];
            const inputElement = document.getElementById(`signature-input-${index}`);
            
            if (!signaturePad || !inputElement) return;

            if (signaturePad.isEmpty()) {
                inputElement.value = '';
            } else {
                const dataURL = signaturePad.toDataURL();
                inputElement.value = dataURL;
                console.log(`Signature ${index} saved:`, inputElement.value.substring(0, 100) + '...');
            }
        }
    </script>
@endpush

