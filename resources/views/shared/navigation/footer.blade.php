@auth
    <footer class="flex flex-col md:flex-row items-center gap-4 md:gap-0 md:justify-between w-full px-4 py-3 bg-white shadow-md">
        <section class="cursor-default flex items-center font-semibold gap-2 text-gray-600">
            <img src="{{ asset('img/logo-beacukai.png') }}" alt="Logo" class="w-6 h-6">
            SIMAP
        </section>
        <section class="cursor-default text-center text-sm text-gray-500 order-last md:order-none">
            &copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai
        </section>
        <section class="flex items-center gap-4">
            <a href="#" class="fab fa-facebook text-gray-400 hover:text-[#1a4167] transition-colors text-xl md:text-base"></a>
            <a href="#" class="fab fa-twitter text-gray-400 hover:text-[#1a4167] transition-colors text-xl md:text-base"></a>
            <a href="#" class="fab fa-instagram text-gray-400 hover:text-[#1a4167] transition-colors text-xl md:text-base"></a>
        </section>
    </footer>
@endauth