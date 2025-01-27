<section class="mt-8 cursor-default flex flex-col items-center overflow-hidden gap-6 p-6 shadow-md rounded-lg bg-white lg:flex-row">
    <i class="fa-solid fa-user-circle flex-shrink-0 bg-gray-100 rounded-full p-4 text-5xl transition-colors text-[#1a4167] hover:text-gray-600"></i>
    <div class="flex flex-col">
        <h3 class="mb-3 font-semibold text-xl text-gray-900">Informasi Akun</h3>
        <span class="flex items-center mb-3">
            <h5 class="font-medium">Nama:</h5>&emsp;&emsp;
            {{ auth()->user()->name }}
        </span>
        <span class="flex items-center mb-3">
            <h5 class="font-medium">NIP:</h5>&emsp;&emsp;&emsp;
            {{ auth()->user()->nip }}
        </span>
        <span class="flex items-center mb-3">
            <h5 class="font-medium">Email:</h5>&emsp;&emsp;
            {{ auth()->user()->email }}
        </span>
    </div>
</section>