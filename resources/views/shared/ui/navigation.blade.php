<nav class="mb-4 flex space-x-8">
    @foreach ($tabs as $tab)
        <button
            type="button"
            class="tab-button {{ $tab['active'] ?? false ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500 hover:border-b-2 hover:border-gray-300 hover:text-gray-700' }} px-1 py-4 text-sm font-medium"
            data-tab="{{ $tab['id'] }}"
        >
            {{ $tab['label'] }}
        </button>
    @endforeach
</nav>