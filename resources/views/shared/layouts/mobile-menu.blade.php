<div class="md:hidden hidden w-full transition-all duration-300" id="mobile-menu">
    <div class="py-4 space-y-4 flex flex-col w-full ml-4">
        <a href="/"
            class="mobile-nav-link text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('/') ? 'active' : '' }}">
            Dashboard
        </a>
        <a href="/intelijen"
            class="mobile-nav-link text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('intelijen*') ? 'active' : '' }}">
            Intelijen
        </a>
        <a href="{{ route('penindakan') }}"
            class="mobile-nav-link text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('penindakan*') ? 'active' : '' }}">
            Penindakan
        </a>
        <div class="h-px w-full bg-gray-200"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left mobile-nav-link text-red-600 hover:text-red-700 hover:bg-red-50 flex items-center gap-2 transition-colors">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>
</div>