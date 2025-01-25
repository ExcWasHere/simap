<main class="w-full min-h-[115vh] flex relative">
    <section class="w-1/2 relative hidden lg:block z-10">
        <span class="absolute inset-0 bg-gradient-to-b from-[#1a4167]/80 to-[#1a4167]/40"></span>
        <img src="{{ asset('img/login-1.jpg') }}" alt="Background" class="w-full h-full object-cover bg-white">
        <div class="absolute bottom-8 left-8 text-white">
            <img src="{{ asset('img/logo-beacukai.png') }}" alt="Logo Bea Cukai" class="w-16 mb-4">
            <h2 class="text-2xl font-bold">Direktorat Jenderal Bea dan Cukai</h2>
            <p class="text-sm mt-2">Kantor Pengawasan dan Pelayanan Bea dan Cukai TMP C Blitar</p>
        </div>
    </section>
    <section class="w-full flex flex-col items-center justify-center px-4 text-black bg-slate-50 lg:w-1/2">
        <header class="mb-6 cursor-default text-center">
            <h3 class="font-bold text-3xl text-[#1a4167]">Selamat Datang</h3>
            <h5 class="mt-2 text-gray-600">
                Silakan masuk ke akun Anda.
            </h5>
        </header>
        <form action="{{ route('login') }}" method="POST" class="w-[65%]">
            @csrf
            <fieldset class="flex flex-col space-y-4">
                <label for="nip">NIP</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                        <i class="fas fa-id-card"></i>
                    </span>
                    <input
                        type="text"
                        name="NIP"
                        id="NIP"
                        class="w-full rounded-lg border-2 pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('nip') border-red-500 @enderror"
                        value="{{ old('NIP') }}"
                        placeholder="Masukkan NIP Anda"
                        autocomplete="NIP"
                        autofocus
                        required
                    />
                    @error('nip')
                        <h6 class="mt-1 text-xs italic text-red-500">{{ $message }}</h6>
                    @enderror
                </div>
            </fieldset>
            <fieldset class="mt-4 flex flex-col space-y-4">
                <label for="password">Kata Sandi Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full rounded-lg border-2 pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan Kata Sandi Baru"
                        autocomplete="current-password"
                        required
                    />
                    @error('password')
                        <h6 class="text-red-500 text-xs italic mt-1">{{ $message }}</h6>
                    @enderror
                </div>
            </fieldset>
            <fieldset class="mt-4 flex flex-col space-y-4">
                <label for="new-password">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <input
                        type="new-password"
                        name="new-password"
                        id="new-password"
                        class="w-full rounded-lg border-2 pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200"
                        placeholder="Konfirmasi Kata Sandi Baru"
                        autocomplete="new-password"
                        required
                    />
                </div>
            </fieldset>
            <button
                type="submit"
                class="mt-6 cursor-pointer w-full py-2.5 px-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 transform focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 hover:scale-[1.02] hover:bg-[#2c5c8f]"
            >
                Ganti Kata Sandi
            </button>
        </form>
        <h5 class="mt-8 cursor-default text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai
        </h5>
    </section>
</main>