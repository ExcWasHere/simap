<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Project01') }} - @yield('title', 'Welcome')</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    <x-loader />

    @if(!Route::is('login'))
        <header class="bg-white shadow-md">
            <nav class="container px-4 py-3 mx-auto">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
                            <a href="/" class="text-xl font-bold text-[#1a4167]">
                                {{ config('app.name', 'Project01') }}
                            </a>
                        </div>
                    </div>

                    <div class="hidden md:flex items-center space-x-6">
                        <a href="/" class="nav-link text-gray-600 hover:text-gray-900 {{ request()->is('/') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="/laporan" class="nav-link text-gray-600 hover:text-gray-900 {{ request()->is('laporan*') ? 'active' : '' }}">
                            Laporan
                        </a>
                        <a href="/upload" class="nav-link text-gray-600 hover:text-gray-900 {{ request()->is('upload*') ? 'active' : '' }}">
                            Upload
                        </a>
                        <div class="h-6 w-px bg-gray-200"></div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center text-gray-600 hover:text-red-600 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-1"></i>
                                Logout
                            </button>
                        </form>
                    </div>

                    <button class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none" id="mobile-menu-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                <div class="md:hidden hidden w-full transition-all duration-300" id="mobile-menu">
                    <div class="py-4 space-y-4 flex flex-col w-full ml-4">
                        <a href="/" class="mobile-nav-link text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('/') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="/laporan" class="mobile-nav-link text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('laporan*') ? 'active' : '' }}">
                            Laporan
                        </a>
                        <a href="/upload" class="mobile-nav-link text-gray-600 hover:text-gray-900 flex items-center gap-2 {{ request()->is('upload*') ? 'active' : '' }}">
                            Upload
                        </a>
                        <div class="h-px w-full bg-gray-200"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left mobile-nav-link text-red-600 hover:text-red-700 hover:bg-red-50 flex items-center gap-2 transition-colors">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
    @endif

    <main class="flex-grow @if(!Route::is('login')) container mx-auto px-4 py-6 @endif">
        @yield('content')
    </main>

    @if(!Route::is('login'))
        <footer class="bg-white shadow-md mt-auto">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-6 h-6">
                        <span class="text-gray-600 font-semibold">{{ config('app.name', 'Laravel') }}</span>
                    </div>
                    <div class="text-center text-gray-500 text-sm">
                        <p>&copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai. All rights reserved.</p>
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-[#1a4167] transition-colors">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-[#1a4167] transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-[#1a4167] transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @stack('scripts')

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>