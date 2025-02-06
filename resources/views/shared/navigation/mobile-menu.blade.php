<section class="hidden flex-col z-40 fixed top-16 inset-x-0 mx-4 bg-white border border-gray-200 rounded-lg shadow-lg lg:hidden" id="mobile-menu">
    <nav class="p-2 space-y-1">
        <a href="/intelijen" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('intelijen*') ? 'font-medium text-blue-600 bg-blue-50' : '' }}">
            Intelijen
        </a>
        <a href="{{ route('penindakan') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('penindakan*') ? 'font-medium text-blue-600 bg-blue-50' : '' }}">
            Penindakan
        </a>
        <a href="{{ route('penyidikan') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('penyidikan*') ? 'font-medium text-blue-600 bg-blue-50' : '' }}">
            Penyidikan
        </a>
        <a href="{{ route('monitoring') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition-colors {{ request()->is('penyidikan*') ? 'font-medium text-blue-600 bg-blue-50' : '' }}">
            Monitoring
        </a>
    </nav>
    <hr class="h-1 text-gray-200" />
    <form method="POST" action="{{ route('logout') }}" class="p-2">
        @csrf
        <button type="submit" class="w-full px-4 py-2 text-left text-red-600 hover:bg-red-50 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
            <i class="fas fa-sign-out-alt mr-2"></i>
            Keluar
        </button>
    </form>
</section>
