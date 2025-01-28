<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if($required ?? false)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <div class="relative">
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            rows="{{ $rows ?? 3 }}"
            class="w-full rounded-lg border-gray-300 shadow-sm px-4 py-2.5 
                   transition duration-150 ease-in-out placeholder-gray-400
                   focus:border-blue-500 focus:ring-blue-500
                   @error($name) border-red-500 ring-1 ring-red-500 @enderror"
            {{ $required ?? false ? 'required' : '' }}
        >{{ old($name) }}</textarea>
        @error($name)
            <div class="absolute top-3 right-0 flex items-center pr-3">
                <i class="fas fa-exclamation-circle text-red-500"></i>
            </div>
        @enderror
    </div>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>