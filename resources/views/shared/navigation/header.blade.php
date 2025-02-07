@auth
    <header class="fixed top-0 left-0 right-0 z-40 w-full px-4 py-3 bg-white shadow-md">
        <div class="mx-auto container flex items-center justify-between">
            <section class="flex items-center gap-5 transition-opacity text-xl font-bold text-[#1a4167] hover:opacity-80">
                <img src="{{ asset('img/logo-beacukai.png') }}" alt="Logo" class="w-8 h-8">
                SIMAP
            </section>
            <nav class="hidden items-center gap-6 lg:flex">
                <a href="/intelijen" class="text-gray-600 hover:text-gray-900 {{ Request::is('/') ? 'active' : '' }}">
                    Intelijen
                </a>
                <a href="/penindakan" class="text-gray-600 hover:text-gray-900 {{ Request::is('intelijen*') ? 'active' : '' }}">
                    Penindakan
                </a>
                <a href="/penyidikan" class="text-gray-600 hover:text-gray-900 {{ Request::is('penyidikan*') ? 'active' : '' }}">
                    Penyidikan
                </a>
                <a href="/monitoring" class="text-gray-600 hover:text-gray-900 {{ Request::is('monitoring*') ? 'active' : '' }}">
                    Monitoring
                </a>
                <span class="h-6 w-px bg-gray-200"></span>
                <form method="POST" action="{{ route('keluar') }}" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="flex cursor-pointer items-center text-gray-600 transition-colors duration-300 hover:text-red-600"
                    >
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        &ensp;Keluar
                    </button>
                </form>
            </nav>
            <button 
                type="button"
                class="fa-solid fa-bars cursor-pointer text-xl text-gray-600 hover:text-gray-900 focus:outline-none lg:!hidden" 
                id="mobile-menu-button"
                aria-label="Toggle mobile menu"
                aria-expanded="false"
                onclick="
                    const menu = document.getElementById('mobile-menu');
                    if (menu) {
                        menu.classList.toggle('hidden');
                        menu.classList.toggle('flex');
                        this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
                    }
                "
            ></button>
            @include('shared.navigation.mobile-menu')
        </div>
    </header>
@endauth

@push('skrip')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menu = document.getElementById('mobile-menu');
            if (menu) {
                menu.classList.add('hidden');
                menu.classList.remove('flex');
            }
        });
    </script>
@endpush