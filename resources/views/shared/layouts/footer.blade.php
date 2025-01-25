@if(!Route::is('login'))
    <footer class="bg-white shadow-md mt-auto">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/logo-beacukai.png') }}" alt="Logo" class="w-6 h-6">
                    <span class="text-gray-600 font-semibold">SIMAP</span>
                </div>
                <div class="text-center text-gray-500 text-sm">
                    <p>&copy; {{ date('Y') }} Direktorat Jenderal Bea dan Cukai. All rights reserved.</p>
                </div>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-[#1a4167] transition-colors">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#1a4167] transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#1a4167] transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
@endif