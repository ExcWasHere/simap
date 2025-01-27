<fieldset>
    <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
    <span class="relative">
        <input
            type="{{ $type }}" name="{{ $name }}"
            class="mt-2 w-full rounded-lg border-gray-300 shadow-sm {{ isset($icon) ? 'pl-10' : 'px-4' }} py-2.5 transition duration-150 ease-in-out placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500"
            {{ $attributes ?? '' }}
        />
    </span>
    @error($name)
        <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
    @enderror
</fieldset>