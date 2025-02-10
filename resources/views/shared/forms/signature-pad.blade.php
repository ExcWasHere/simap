<div class="col-span-6 mt-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
    </label>
    <div class="mt-2 flex flex-col space-y-2">
        <div class="rounded-lg p-4 bg-white shadow-sm">
            <div class="mb-3 flex justify-between items-center">
                <div class="flex space-x-2">
                    <button type="button" id="draw-tab-{{ $index }}"
                        class="px-4 py-2 text-sm font-medium rounded-md bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors">
                        <i class="fas fa-pen mr-2"></i>Draw
                    </button>
                    <button type="button" id="upload-tab-{{ $index }}"
                        class="px-4 py-2 text-sm font-medium rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200 transition-colors">
                        <i class="fas fa-upload mr-2"></i>Upload
                    </button>
                </div>
                <button type="button" id="clear-signature-{{ $index }}"
                    class="px-4 py-2 text-sm font-medium rounded-md text-red-600 hover:bg-red-50 transition-colors">
                    <i class="fas fa-times mr-2"></i>Clear
                </button>
            </div>

            <div id="signature-pad-wrapper-{{ $index }}" class="border rounded bg-gray-50">
                <canvas id="signature-pad-{{ $index }}" class="w-full h-48"></canvas>
            </div>

            <div id="signature-upload-wrapper-{{ $index }}" class="hidden">
                <input type="file" id="signature-upload-{{ $index }}" accept="image/*"
                    class="w-full p-2 border rounded" onchange="handleSignatureUpload(this, {{ $index }})">
            </div>

            <input type="hidden" name="{{ $name }}" id="signature-input-{{ $index }}">
        </div>
    </div>
</div>

@push('skrip')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        let signaturePads = {};

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[id^="signature-pad-"]').forEach(canvas => {
                const index = canvas.id.split('-').pop();
                initSignaturePad(index);
                initializeTabEvents(index);
            });
        })

        function initSignaturePad(index) {
            const canvas = document.getElementById(`signature-pad-${index}`);
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(248, 250, 252)',
                penColor: 'rgb(0, 0, 0)',
                minWidth: 1,
                maxWidth: 2.5
            });

            function resizeCanvas() {
                const wrapper = canvas.parentElement;
                canvas.width = wrapper.clientWidth;
                canvas.height = wrapper.clientHeight;
                signaturePad.clear();
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            signaturePads[index] = signaturePad;

            document.getElementById(`clear-signature-${index}`).addEventListener('click', function() {
                signaturePad.clear();
                document.getElementById(`signature-input-${index}`).value = '';
                document.getElementById(`signature-upload-${index}`).value = '';
            });
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

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(`signature-input-${index}`).value = e.target.result;

                const img = new Image();
                img.onload = function() {
                    const canvas = document.getElementById(`signature-pad-${index}`);
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

        function saveSignature(index) {
            if (signaturePads[index].isEmpty()) {
                document.getElementById(`signature-input-${index}`).value = '';
                return;
            }

            const dataURL = signaturePads[index].toDataURL();
            document.getElementById(`signature-input-${index}`).value = dataURL;
        }
    </script>
@endpush
