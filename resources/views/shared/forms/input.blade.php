<fieldset>
    <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <span class="relative">
        <input
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            id="{{ $id ?? $name }}"
            value="{{ old($name) }}"
            class="w-full rounded-lg shadow-sm px-4 py-2.5  transition duration-150 ease-in-out placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 @error($name) border-red-500 ring-1 ring-red-500 @enderror"
            {{ $required ?? false ? 'required' : '' }}
            {{ $attributes ?? '' }}
        />
        @error($name)
            <i class="fas fa-exclamation-circle text-red-500 absolute inset-y-0 right-0 flex items-center pr-3"></i>
        @enderror
    </span>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</fieldset>