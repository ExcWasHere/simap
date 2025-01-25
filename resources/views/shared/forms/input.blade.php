<div class="relative">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <div class="relative">
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            class="w-full rounded-lg border-gray-300 shadow-sm
                   {{ isset($icon) ? 'pl-10' : 'px-4' }} py-2.5
                   focus:border-blue-500 focus:ring-blue-500 
                   transition duration-150 ease-in-out
                   placeholder-gray-400"
            {{ $attributes ?? '' }}
        >
    </div>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div> 