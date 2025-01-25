@auth
    <footer class="w-full px-4 py-3 bg-white shadow-md">
        <div class="mx-auto container flex items-center justify-between">
            <section class="flex items-center font-semibold gap-2 text-gray-600">
                <img src="{{ asset('img/logo-beacukai.png') }}" alt="Logo" class="w-6 h-6">
                SIMAP
            </section>
            <section class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai. All rights reserved.
            </section>
            <section class="flex items-center gap-4">
                <a href="#" class="fab fa-facebook text-gray-400 hover:text-[#1a4167] transition-colors"></a>
                <a href="#" class="fab fa-twitter text-gray-400 hover:text-[#1a4167] transition-colors"></a>
                <a href="#" class="fab fa-instagram text-gray-400 hover:text-[#1a4167] transition-colors"></a>
            </section>
        </div>
    </footer>
@endauth