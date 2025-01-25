<div class="relative">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <div class="relative rounded-lg shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm font-medium">Rp</span>
        </div>
        <input 
            type="text" 
            name="{{ $name }}"
            class="w-full rounded-lg border-gray-300 shadow-sm
                   pl-12 pr-4 py-2.5
                   focus:border-blue-500 focus:ring-blue-500 
                   transition duration-150 ease-in-out
                   placeholder-gray-400"
            placeholder="0"
            {{ $attributes ?? '' }}
        >
    </div>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>