<section class="w-1/2 relative hidden lg:inline">
    <span class="absolute inset-0 bg-gradient-to-b from-[#1a4167]/80 to-[#1a4167]/40 transition-opacity duration-300"></span>
    <img
        src="{{ asset('img/login-1.jpg') }}"
        alt="Background"
        class="carousel-image w-full h-full object-cover bg-white transition-opacity duration-300"
        loading="lazy"
        data-index="0"
    />
    <figure class="absolute bottom-8 left-8 text-white space-y-2">
        <img
            id="carousel-img"
            src="{{ asset('img/logo-beacukai.png') }}" alt="Logo Bea Cukai"
            class="w-16 mb-4 transform hover:scale-105 transition-transform duration-300"
            loading="lazy"
        />
        <h4 class="text-2xl font-bold tracking-tight">Direktorat Jenderal Bea dan Cukai</h4>
        <h6 class="text-sm text-gray-200">Kantor Pengawasan dan Pelayanan Bea dan Cukai TMP C Blitar</h6>
        <div class="carousel-pointer mt-4 flex h-fit space-x-4">
            <span data-index="0" class="carousel-indicator cursor-pointer h-3 w-3 rounded-full border-2 bg-white border-white"></span>
            <span data-index="1" class="carousel-indicator cursor-pointer h-3 w-3 rounded-full border-2 border-white"></span>
            <span data-index="2" class="carousel-indicator cursor-pointer h-3 w-3 rounded-full border-2 border-white"></span>
        </div>
    </figure>
</section>