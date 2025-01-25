@if(!Route::is('login'))
    <header class="bg-white shadow-md">
        <nav class="container px-4 py-3 mx-auto">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('img/logo-beacukai.png') }}" alt="Logo" class="w-8 h-8">
                        <a href="/" class="text-xl font-bold text-[#1a4167]">SIMAP</a>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="nav-link text-gray-600 hover:text-gray-900 {{ request()->is('/') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="/intelijen"
                        class="nav-link text-gray-600 hover:text-gray-900 {{ request()->is('intelijen*') ? 'active' : '' }}">
                        Intelijen
                    </a>
                    <a href="/penindakan"
                        class="nav-link text-gray-600 hover:text-gray-900 {{ request()->is('penindakan*') ? 'active' : '' }}">
                        Penindakan
                    </a>
                    <div class="h-6 w-px bg-gray-200"></div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="flex items-center text-gray-600 hover:text-red-600 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Logout
                        </button>
                    </form>
                </div>

                <button class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            @include('shared.layouts.mobile-menu')
        </nav>
    </header>
@endif