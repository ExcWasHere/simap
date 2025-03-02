<fieldset>
    <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <select
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="appearance-none w-full rounded-lg shadow-sm px-4 py-2.5  transition duration-150 ease-in-out placeholder-gray-400  focus:border-blue-500 focus:ring-blue-500 @error($name) border-red-500 ring-1 ring-red-500 @enderror"
        {{ isset($conditionalRequired) ? ($conditionalRequired ? 'required' : '') : ($required ?? false ? 'required' : '') }}
    >
        <option>Pilih {{ $label }}</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @error($name)
        <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
    @enderror
</fieldset>