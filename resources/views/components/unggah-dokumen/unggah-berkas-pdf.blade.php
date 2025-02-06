<fieldset class="space-y-2">
    <h6 class="text-sm font-medium text-gray-700">
        Unggah Berkas PDF <span class="text-red-500">*</span>
    </h6>
    <label for="file" class="mt-1 cursor-pointer flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 relative" id="drop-zone">
        <div class="space-y-1 text-center" id="upload-state">
            <i class="fa-regular fa-image text-gray-400 text-xl"></i>
            <span class="flex text-sm text-gray-600 justify-center">
                <h5 class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                    Unggah Berkas
                </h5>
                <input id="file" name="file" type="file" class="sr-only" accept=".pdf" required />
                <h6 class="pl-1 italic">atau seret dan lepas.</h6>
            </span>
        </div>
        <div id="selected-file-state" class="hidden overflow-hidden">
            <div class="w-72 flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200 lg:w-130">
                <span class="flex items-center space-x-3">
                    <i class="fa-solid fa-file-pdf flex-shrink-0 text-red-500 text-2xl"></i>
                    <p class="min-w-0 flex-1">
                        <h5 id="selected-file" class="text-sm font-medium text-gray-900 truncate"></h5>
                        <h5 id="file-size" class="text-sm text-gray-500"></h5>
                    </p>
                </span>
                <button type="button" id="remove-file" class="inline-flex items-center rounded-full border border-gray-200 p-1 text-gray-400 hover:bg-gray-50 hover:text-gray-500">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <div id="upload-progress" class="hidden mt-4 w-full overflow-hidden">
                <span class="flex justify-between text-sm text-gray-600 mb-1">
                    <h5>Unggah Progres</h5>
                    <h5 id="progress-percentage">0%</h5>
                </span>
                <div class="overflow-hidden rounded-full bg-gray-200">
                    <span id="progress-bar" class="h-2 rounded-full bg-blue-600 transition-all duration-300" style="width: 0%"></span>
                </div>
            </div>
        </div>
        <div id="drag-over-state" class="hidden inset-0 backdrop-blur-sm bg-blue-50/90 rounded-lg border-2 border-blue-500">
            <span class="h-full flex items-center justify-center text-center">
                <i class="fa-solid fa-file-arrow-down text-blue-500 text-4xl mb-2"></i>
                <h5 class="text-blue-600 font-medium">Lepaskan berkas untuk mengunggah</h5>
            </span>
        </div>
    </label>
</fieldset>