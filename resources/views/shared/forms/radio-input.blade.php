<span class="flex items-center gap-2">
    <input 
        type="radio" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="cursor-pointer" 
        {{ $attributes ?? '' }}
        {{ $checked ?? false ? 'checked' : '' }}
    />
    <label 
        for="{{ $id }}" 
        class="cursor-pointer text-gray-700"
    >
        {{ $label }}
    </label>
</span> 