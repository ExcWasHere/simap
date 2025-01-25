<section class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-2">
    @php
        $props = [
            [
                'ikon' => 'fa-solid fa-search',
                'judul' => 'Intelijen',
                'deskripsi' => 'Manajemen data intelijen dan pengawasan',
                'warna' => 'blue',
            ], 
            [
                'ikon' => 'fa-solid fa-shield-alt',
                'judul' => 'Penindakan',
                'deskripsi' => 'Sistem penindakan dan penegakan hukum',
                'warna' => 'orange',
            ],
            [
                'ikon' => 'fa-solid fa-file-alt',
                'judul' => 'Penyidikan',
                'deskripsi' => 'Proses penyidikan dan dokumentasi',
                'warna' => 'emerald',
            ], 
            [
                'ikon' => 'fa-solid fa-chart-line',
                'judul' => 'Monitoring BHP',
                'deskripsi' => 'Pengawasan Barang Hasil Penindakan',
                'warna' => 'purple',
            ],
        ];
    @endphp
    @foreach ($props as $list)
        <figure class="p-6 rounded-lg shadow-md bg-white transition-shadow hover:shadow-lg">
            <span class="flex items-center gap-4">
                <i class="{{ $list['ikon'] }} p-3 rounded-lg text-2xl bg-{{ $list['warna'] }}-100 text-{{ $list['warna'] }}-600"></i>
                <figcaption class="cursor-default">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $list['judul'] }}</h3>
                    <h5 class="text-sm text-gray-600">{{ $list['deskripsi'] }}</h5>
                </figcaption>
            </span>
            <a
                href="/{{ strtolower(str_replace(' ', '-', $list['judul'])) }}"
                class="mt-4 inline-block w-full text-center py-2 rounded-lg transition-colors bg-{{ $list['warna'] }}-50 text-{{ $list['warna'] }}-600 hover:bg-{{ $list['warna'] }}-100"
            >
                Akses Menu
            </a>
        </figure>
    @endforeach
</section>