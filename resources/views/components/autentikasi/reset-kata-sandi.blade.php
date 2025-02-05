<main class="w-full min-h-screen flex relative">
    @include('shared.ui.image')
    <section class="w-full flex flex-col items-center justify-center text-black bg-slate-50 lg:w-1/2 lg:px-4">
        <header class="mb-6 cursor-default text-center">
            <h3 class="font-bold text-3xl text-[#1a4167]">Reset Kata Sandi</h3>
            <h5 class="mt-2 text-gray-600">
                Masukkan kata sandi baru Anda.
            </h5>
        </header>

        @if($errors->any())
            <div class="w-[65%] mb-4">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
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
                class="mt-6 cursor-pointer w-full p-4 rounded-lg bg-[#1a4167] text-white font-semibold transition-all duration-200 transform focus:outline-none focus:ring-2 focus:ring-[#1a4167]/50 hover:scale-[1.005] hover:bg-[#2c5c8f] disabled:opacity-50 disabled:cursor-not-allowed"
                id="submitButton"
            >
                <span class="inline-flex items-center">
                    <span id="buttonText">Reset Kata Sandi</span>
                    <svg id="loadingIcon" class="hidden ml-3 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </form>

        <a href="/login" class="mt-6 text-center text-sm transition-colors duration-200 text-[#1a4167] hover:text-[#2c5c8f]">
            <i class="fas fa-arrow-left"></i>
            &ensp;Kembali Ke Login
        </a>
    </section>
</main>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const button = document.getElementById('submitButton');
    const buttonText = document.getElementById('buttonText');
    const loadingIcon = document.getElementById('loadingIcon');
    
    button.disabled = true;
    buttonText.textContent = 'Memproses...';
    loadingIcon.classList.remove('hidden');
});
</script> 