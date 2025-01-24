<main class="h-screen w-full flex">
    <section class="w-1/2 relative hidden lg:block">
        
    </section>
    <section class="w-full flex flex-col items-center justify-center px-4 text-black bg-slate-50 lg:w-1/2">
        <h3 class="cursor-default font-bold text-3xl text-[#1a4167]">Selamat Datang</h3>
        <h5 class="cursor-default mb-6 mt-2 text-gray-600">
            Silakan masuk ke akun Anda.
        </h5>
        <form action="{{ route('login') }}" method="POST" class="w-[65%]">
            @csrf
            <fieldset class="flex flex-col space-y-4">
                <label for="nip">NIP</label>
                <input
                    type="text"
                    inputmode="numeric"
                    name="nip"
                    id="nip"
                    placeholder="Masukkan NIP Anda."
                    value="{{ old('nip') }}"
                    autocomplete="off"
                    class="shadow-sm border-2 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('nip') border-red-500 @enderror"
                    autofocus
                    required
                />
                @error('nip')
                    <p class="mt-1 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="mt-4 flex flex-col space-y-4">
                <label for="password">Kata Sandi</label>
                <input
                    type="text"
                    inputmode="numeric"
                    name="password"
                    id="password"
                    placeholder="Masukkan NIP Anda."
                    value="{{ old('password') }}"
                    autocomplete="off"
                    class="shadow-sm border-2 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('password') border-red-500 @enderror"
                    autofocus
                    required
                />
                @error('password')
                    <p class="mt-1 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <div class="mt-6 gap-2 flex flex-col lg:gap-0 lg:items-center lg:flex-row lg:justify-between">
                <span class="flex items-center gap-1">
                    <input
                        type="checkbox" name="remember" id="remember" 
                        class="w-4 h-4 rounded border-gray-300 text-[#1a4167] focus:ring-[#1a4167]/20"
                        {{ old('remember') ? 'checked' : '' }}
                    />
                    <label for="remember" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
                </span>
                <a href="/lupa-kata-sandi" class="text-sm text-[#1a4167] hover:text-[#2c5c8f] transition-colors duration-200">
                    Lupa Kata Sandi?
                </a>
            </div>
            <button
                type="submit"
                class="mt-6 w-full py-2.5 px-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 transform focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 hover:scale-[1.02] hover:bg-[#2c5c8f]"
            >
                Login
            </button>
        </form>
    </section>
</main>