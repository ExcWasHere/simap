<main class="w-full min-h-screen flex relative">
    @include('shared.ui.image')

    <section class="w-full flex flex-col items-center justify-center text-black bg-slate-50 lg:w-1/2 lg:px-4">
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
                <label for="password">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full rounded-lg border-2 pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan Kata Sandi Anda"
                        autocomplete="current-password"
                        required
                    />
                    @error('password')
                        <h6 class="text-red-500 text-xs italic mt-1">{{ $message }}</h6>
                    @enderror
                </div>
            </fieldset>
            <div class="mt-6 gap-2 flex flex-col lg:gap-0 lg:items-center lg:flex-row lg:justify-between">
                <span class="flex items-center gap-1">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 rounded border-gray-300 text-[#1a4167] focus:ring-[#1a4167]/20"
                        {{ old('remember') ? 'checked' : '' }} />
                    <label for="remember" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
                </span>
                <a href="/lupa-kata-sandi"
                    class="text-sm text-[#1a4167] hover:text-[#2c5c8f] transition-colors duration-200">
                    Lupa Kata Sandi?
                </a>
            </div>
            <button
                type="submit"
                class="mt-6 cursor-pointer w-full py-2.5 px-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 transform focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 hover:scale-[1.02] hover:bg-[#2c5c8f]"
            >
                Login
            </button>
        </form>
        <h5 class="mt-8 cursor-default text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai
        </h5>
    </section>
</main>