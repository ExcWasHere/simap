<fieldset>
    <label class="text-sm font-medium text-gray-700">{{ $label }}</label>
    <textarea
        name="{{ $name }}"
        class="mt-2 w-full rounded-lg border-gray-300 shadow-sm px-4 py-2.5 transition duration-150 ease-in-out placeholder-gray-400 resize-none focus:border-blue-500 focus:ring-blue-500"
        {{ $attributes ?? '' }} rows="{{ $rows ?? 3 }}"
    ></textarea>
    @error($name)
        <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
    @enderror
</fieldset>