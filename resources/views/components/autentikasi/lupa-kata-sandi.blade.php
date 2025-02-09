<main class="w-full min-h-screen flex relative">
    @include('shared.ui.image')
    <section class="w-full flex flex-col items-center justify-center text-black bg-slate-50 lg:w-1/2 lg:px-4" style="background: url({{ asset('img/latar-belakang.svg') }})">
        <header class="mb-6 cursor-default text-center">
            <h3 class="font-bold text-3xl text-[#1a4167]">Reset Kata Sandi</h3>
            <h5 class="mt-2 text-gray-600">
                Masukkan NIP Anda untuk menerima tautan reset kata sandi.
            </h5>
        </header>
        @if (session('success'))
            <div class="flex items-center w-3/4 mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <i class="fa-solid fa-circle-check text-green-400"></i>
                <h6 class="ml-3 text-sm text-green-700">{{ session('success') }}</h6>
            </div>
        @endif
        @if ($errors->any())
            <div class="flex items-center w-3/4 mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <i class="fa-solid fa-circle-x text-red-400"></i>
                <h5 class="ml-3 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </h5>
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="w-3/4">
            @csrf
            <fieldset class="flex flex-col space-y-4">
                <label for="nip" class="font-medium text-gray-700">NIP</label>
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
                        pattern="\d{10}"
                        title="NIP harus terdiri dari 10 digit angka"
                    />
                </div>
            </fieldset>
            <button
                type="submit"
                class="mt-6 cursor-pointer w-full flex items-center justify-center p-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 transform focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 hover:scale-[1.005] hover:bg-[#2c5c8f] disabled:opacity-50 disabled:cursor-not-allowed"
                id="submit-button"
            >
                <h5 id="button-text">Kirim Tautan Reset</h5>
                <i class="fa-solid fa-o !hidden ml-3 mt-0.5 animate-spin text-white" id="loading-icon"></i>
            </button>
        </form>
        <a href="/masuk" class="mt-6 text-center text-sm transition-colors duration-200 text-[#1a4167] hover:text-[#2c5c8f]">
            <i class="fas fa-arrow-left"></i>
            &ensp;Kembali
        </a>
    </section>
</main>

@push('skrip')
    <script>
        document.querySelector('form').addEventListener('submit', (e) => {
            const button = document.getElementById('submit-button');
            const button_text = document.getElementById('button-text');
            const loading_icon = document.getElementById('loading-icon');

            button.disabled = true;
            button_text.textContent = 'Mengirim...';
            loading_icon.classList.remove('!hidden');
        });
    </script>
@endpush