<div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
    <div class="relative">
        <img
            id="loaderLogo"
            src="{{ asset('img/logo-beacukai.png') }}"
            alt=""
            class="h-32 w-32 object-contain opacity-0 scale-50"
        />
        <div id="loaderRings" class="absolute inset-0">
            <div class="absolute inset-0 border-4 border-blue-200 rounded-full animate-ping"></div>
            <div class="absolute inset-0 border-4 border-blue-400 rounded-full animate-pulse"></div>
        </div>
    </div>
</div>