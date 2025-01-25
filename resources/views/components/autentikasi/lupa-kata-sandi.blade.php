<main class="w-full min-h-screen flex relative bg-slate-50">
    @include('shared.ui.image')

    <section class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-12">
        <div class="w-full max-w-md space-y-8">
            <header class="text-center space-y-2">
                <h3 class="text-3xl font-bold text-[#1a4167] tracking-tight">Lupa Kata Sandi?</h3>
                <p class="text-gray-600">
                    Masukkan NIP Anda untuk menerima email reset kata sandi
                </p>
            </header>

            <form action="" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="space-y-2">
                    <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fas fa-id-card"></i>
                        </span>
                        <input
                            type="text"
                            name="NIP"
                            id="NIP"
                            class="w-full px-12 py-3 border-2 rounded-lg bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('NIP') border-red-500 @enderror"
                            value="{{ old('NIP') }}"
                            placeholder="Masukkan NIP Anda"
                            required
                            autocomplete="off"
                        >
                    </div>
                    @error('NIP')
                        <p class="mt-1 text-sm text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <button 
                        type="submit" 
                        class="w-full py-3 px-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 hover:bg-[#2c5c8f] focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 transform hover:scale-[1.02]"
                    >
                        Kirim Link Reset
                    </button>

                    <a 
                        href="{{ route('login') }}" 
                        class="block text-center text-sm text-[#1a4167] hover:text-[#2c5c8f] transition-colors duration-200"
                    >
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Login
                    </a>
                </div>
            </form>

            <footer class="text-center">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai
                </p>
            </footer>
        </div>
    </section>
</main>