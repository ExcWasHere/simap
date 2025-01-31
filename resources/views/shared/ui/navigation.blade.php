<nav class="border-b border-gray-200">
    <div class="flex space-x-8" role="tablist">
        @foreach($tabs as $tab)
        <button 
            type="button"
            class="px-4 py-2 text-sm font-medium border-b-2 {{ $tab['active'] ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
            data-tab="{{ $tab['id'] }}"
            role="tab"
            aria-controls="{{ $tab['id'] }}-content"
            aria-selected="{{ $tab['active'] ? 'true' : 'false' }}">
            {{ $tab['label'] }}
        </button>
        @endforeach
    </div>
</nav>