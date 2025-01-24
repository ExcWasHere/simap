<main class="w-full min-h-screen flex relative">

    <section class="w-1/2 relative hidden lg:block z-10">
        <div class="absolute inset-0 bg-gradient-to-b from-[#1a4167]/80 to-[#1a4167]/40"></div>
        <img src="{{ asset('img/login-1.jpg') }}" alt="Background" class="w-full h-full object-cover bg-white">
        <div class="absolute bottom-8 left-8 text-white">
            <img src="{{ asset('img/logo-beacukai.png') }}" alt="Logo Bea Cukai" class="w-16 mb-4">
            <h2 class="text-2xl font-bold">Direktorat Jenderal Bea dan Cukai</h2>
            <p class="text-sm mt-2">Kantor Pengawasan dan Pelayanan Bea dan Cukai TMP C Blitar</p>
        </div>
    </section>

    <section class="w-full lg:w-1/2  flex items-center justify-center px-4 z-10">
        <div class="w-full max-w-md px-8 py-6">
            <header class="text-center mb-8">
                <h2 class="text-3xl font-bold text-[#1a4167]">Selamat Datang</h2>
                <p class="text-gray-600 mt-2">Silahkan masuk ke akun anda</p>
            </header>

            <article class="space-y-6">
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <fieldset class="mb-4">
                        <label for="NIP" class="block text-gray-700 text-sm font-semibold mb-2">Nomor Induk Pegawai (NIP)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                <i class="fas fa-id-card"></i>
                            </span>
                            <input type="text" name="NIP" id="NIP"
                                class="pl-10 w-full rounded-lg border-2 py-3 px-4 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('nip') border-red-500 @enderror"
                                value="{{ old('NIP') }}" placeholder="Masukkan NIP Anda" required autocomplete="NIP"
                                autofocus>
                            @error('NIP')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </fieldset>

                    <fieldset class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password"
                                class="pl-10 w-full rounded-lg border-2 py-3 px-4 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('password') border-red-500 @enderror"
                                placeholder="Masukkan Password Anda"
                                required autocomplete="current-password">
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="flex items-center justify-between mb-6">
                        <fieldset class="flex items-center">
                            <input type="checkbox" name="remember" id="remember"
                                class="w-4 h-4 rounded border-gray-300 text-[#1a4167] focus:ring-[#1a4167]/20"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
                        </fieldset>
                        <nav>
                            <a href="/forgot-password"
                                class="text-sm text-[#1a4167] hover:text-[#2c5c8f] transition-colors duration-200">
                                Lupa Password?
                            </a>
                        </nav>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#1a4167] hover:bg-[#2c5c8f] text-white font-semibold py-2.5 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 transition-all duration-200 transform hover:scale-[1.02]">
                        Login
                    </button>

                </form>
                <p class="mt-8 text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai
                </p>
            </article>
        </div>
    </section>
</main>