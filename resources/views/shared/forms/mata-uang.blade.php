<fieldset>
    <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if ($required ?? false)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 sm:text-sm">
            Rp
        </span>
        <input
            type="text"
            name="{{ $name }}"
            id="{{ $id ?? $name }}"
            value="{{ old($name) }}"
            class="w-full rounded-lg pl-12 pr-4 py-2.5 transition duration-150 ease-in-out placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 @error($name) border-red-500 ring-1 ring-red-500 @enderror"
            placeholder="0" {{ $required ?? false ? 'required' : '' }}
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
        />
        @error($name)
            <i class="fas fa-exclamation-circle text-red-500 absolute inset-y-0 right-0 flex items-center pr-3"></i>
        @enderror
    </div>
    @error($name)
        <h6 class="mt-1 text-sm text-red-600">{{ $message }}</h6>
    @enderror
</fieldset>