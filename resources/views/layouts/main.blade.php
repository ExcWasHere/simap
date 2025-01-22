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

<body class="min-h-screen bg-gray-100">
    <x-loader />

    @if(!Route::is('login'))
        <header class="bg-white shadow">
            <nav class="container px-4 py-4 mx-auto">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <a href="/" class="text-xl font-bold text-gray-800">
                            {{ config('app.name', 'Project01') }}
                        </a>
                    </div>

                    <div class="hidden md:flex space-x-4">
                        <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
                        @auth
                            <a href="/dashboard" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-gray-900">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>
    @endif

    <main class="@if(!Route::is('login')) container mx-auto @endif">
        @yield('content')
    </main>

    @if(!Route::is('login'))
        <footer class="bg-white shadow mt-auto">
            <div class="container mx-auto px-4 py-6">
                <div class="text-center text-gray-600">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                </div>
            </div>
        </footer>
    @endif

    @stack('scripts')
</body>

</html>