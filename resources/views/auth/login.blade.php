@extends('layouts.main')

@section('content')
<section class="w-full min-h-screen flex">
    <div class="w-1/2 h-screen relative hidden md:block">
        <div class="absolute inset-0 bg-[#1a4167] opacity-80 z-10"></div>
        
        <div class="carousel relative w-full h-full">
            <div class="carousel-inner w-full h-full">
                <img src="{{ asset('images/Login3.jpg') }}" alt="Login Background 1" class="carousel-item w-full h-full object-cover absolute">
                <img src="{{ asset('images/Login2.jpg') }}" alt="Login Background 2" class="carousel-item w-full h-full object-cover absolute opacity-0">
                <img src="{{ asset('images/Login4.jpg') }}" alt="Login Background 3" class="carousel-item w-full h-full object-cover absolute opacity-0">
            </div>
            
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                <button class="carousel-dot w-2 h-2 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-200"></button>
                <button class="carousel-dot w-2 h-2 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-200"></button>
                <button class="carousel-dot w-2 h-2 rounded-full bg-white opacity-50 hover:opacity-100 transition-opacity duration-200"></button>
            </div>
        </div>

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center z-20">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bea Cukai" class="w-32 object-contain mx-auto mb-4">
            <h2 class="text-white text-2xl font-bold">Direktorat Jenderal Bea dan Cukai</h2>
            <p class="text-white mt-2">Kantor Cabang Kota Blitar</p>
        </div>
    </div>

    <div class="w-full md:w-1/2 bg-gray-50 flex items-center justify-center px-4">
        <div class="w-full max-w-md px-8 py-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-[#1a4167]">Selamat Datang</h1>
                <p class="text-gray-600 mt-2">Silahkan masuk ke akun anda</p>
            </div>

            <div class="space-y-6">
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="NIP" class="block text-gray-700 text-sm font-semibold mb-2">NIP</label>
                        <div class="relative">
                            <input type="text" name="NIP" id="NIP"
                                class="shadow-sm border-2 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('NIP') border-red-500 @enderror"
                                value="{{ old('NIP') }}" 
                                required autocomplete="NIP" autofocus>
                            @error('NIP')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="shadow-sm border-2 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('password') border-red-500 @enderror"
                                required autocomplete="current-password">
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" 
                                class="w-4 h-4 rounded border-gray-300 text-[#1a4167] focus:ring-[#1a4167]/20"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
                        </div>
                        <a href="/forgot-password" class="text-sm text-[#1a4167] hover:text-[#2c5c8f] transition-colors duration-200">
                            Lupa Password?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#1a4167] hover:bg-[#2c5c8f] text-white font-semibold py-2.5 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 transition-all duration-200 transform hover:scale-[1.02]">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection