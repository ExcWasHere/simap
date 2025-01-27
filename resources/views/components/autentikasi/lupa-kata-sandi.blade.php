<main class="w-full min-h-screen flex relative">
    @include('shared.ui.image')
    <section class="w-full flex flex-col items-center justify-center text-black bg-slate-50 lg:w-1/2 lg:px-4">
        <header class="mb-6 cursor-default text-center">
            <h3 class="font-bold text-3xl text-[#1a4167]">Selamat Datang</h3>
            <h5 class="mt-2 text-gray-600">
                Silakan masuk ke akun Anda.
            </h5>
        </header>
        <form action="" method="POST" class="w-[65%]">
            @csrf
            <fieldset class="flex flex-col space-y-4">
                <label for="nip">NIP</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                        <i class="fas fa-id-card"></i>
                    </span>
                    <input
                        type="text"
                        name="nip"
                        id="nip"
                        class="w-full rounded-lg border-2 pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('nip') border-red-500 @enderror"
                        value="{{ old('nip') }}"
                        placeholder="Masukkan NIP Anda"
                        autocomplete="off"
                        required
                    />
                    @error('nip')
                        <h6 class="mt-1 text-xs italic text-red-500">{{ $message }}</h6>
                    @enderror
                </div>
            </fieldset>
            <button
                type="submit"
                class="mt-6 cursor-pointer w-full p-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 transform focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 hover:scale-[1.02] hover:bg-[#2c5c8f]"
            >
                Kirim Tautan Reset
            </button>
        </form>
        <a href="/login" class="mt-6 text-center text-sm transition-colors duration-200 text-[#1a4167] hover:text-[#2c5c8f]">
            <i class="fas fa-arrow-left"></i>
            &ensp;Kembali Ke Login
        </a>
        <h5 class="mt-8 cursor-default text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai
        </h5>
    </section>
</main>