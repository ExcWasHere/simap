<div class="hidden flex-col z-50 container mx-auto p-4 gap-4 bg-white absolute top-14 left-0 w-full transition-all duration-300 lg:hidden" id="mobile-menu">
    <a href="/"
        class="text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('/') ? 'active' : '' }}">
        Dashboard
    </a>
    <a href="/intelijen"
        class="text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('intelijen*') ? 'active' : '' }}">
        Intelijen
    </a>
    <a href="{{ route('penindakan') }}"
        class="text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('penindakan*') ? 'active' : '' }}">
        Penindakan
    </a>
    <div class="h-px w-full bg-gray-200"></div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            type="submit"
            class="flex w-full items-center text-left text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors"
        >
            <i class="fas fa-sign-out-alt"></i>
            &ensp;Keluar
        </button>
    </form>
</div>