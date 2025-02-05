<fieldset>
    <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <span class="relative">
        <textarea
            name="{{ $name }}"
            id="{{ $id ?? $name }}"
            rows="{{ $rows ?? 3 }}"
            class="w-full rounded-lg shadow-sm px-4 py-2.5 resize-none transition duration-150 ease-in-out placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 @error($name) border-red-500 ring-1 ring-red-500 @enderror"
            {{ $required ?? false ? 'required' : '' }}
        >{{ old($name) }}</textarea>
        @error($name)
            <i class="fas fa-exclamation-circle text-red-500 absolute top-3 right-0 flex items-center pr-3"></i>
        @enderror
    </span>
    @error($name)
        <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
    @enderror
</fieldset>