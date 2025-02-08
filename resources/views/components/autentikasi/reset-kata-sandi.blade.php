<main class="w-full min-h-[120vh] flex relative xl:min-h-screen">
    @include('shared.ui.image')
    <section class="w-full flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat bg-gradient-to-lr from-[#a9d6ff] to-[#edf2f7] text-black lg:w-1/2 lg:px-4" style="background: url({{ asset('img/latar-belakang.svg') }})">
        <header class="mb-6 cursor-default text-center">
            <h3 class="font-bold text-3xl text-[#1a4167]">Reset Kata Sandi</h3>
            <h5 class="mt-2 text-gray-600">
                Masukkan kata sandi baru Anda.
            </h5>
        </header>
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
        <form action="{{ route('password.update') }}" method="POST" class="w-[65%]">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="nip" value="{{ $nip }}">
            <fieldset class="flex flex-col space-y-4">
                <label for="password" class="font-medium text-gray-700">Kata Sandi Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full rounded-lg border-2 pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan kata sandi baru"
                        required
                        minlength="8"
                    />
                </div>
            </fieldset>
            <fieldset class="mt-4 flex flex-col space-y-4">
                <label for="password_confirmation" class="font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="w-full rounded-lg border-2 pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 transition-all duration-200"
                        placeholder="Konfirmasi kata sandi baru"
                        required
                        minlength="8"
                    />
                </div>
            </fieldset>
            <button
                type="submit"
                class="mt-6 cursor-pointer w-full flex items-center justify-center p-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 transform focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 hover:scale-[1.005] hover:bg-[#2c5c8f] disabled:opacity-50 disabled:cursor-not-allowed"
                id="submit-button"
            >
                <h5 id="button-text">Reset Kata Sandi</h5>
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
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = document.getElementById('submit-button');
            const button_text = document.getElementById('button-text');
            const loading_icon = document.getElementById('loading-icon');

            button.disabled = true;
            button_text.textContent = 'Memproses...';
            loading_icon.classList.remove('hidden');
        });
    </script>
@endpush