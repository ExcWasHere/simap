@extends('layouts.main')

@section('title', 'Data Penindakan')

@section('content')
<div class="relative w-full min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/BG.jpg') }}')">
    <div class="absolute inset-0 bg-white bg-opacity-80"></div>
    <div class="relative container mx-auto px-4 py-2 z-10">
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-8 border border-white/20">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-black">Data Penindakan</h1>
                <form method="GET" action="{{ route('penindakan.penindakan') }}" class="flex gap-4">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari data penindakan..."
                            class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-black placeholder-white/50 focus:outline-none focus:border-amber-500/50 w-full"
                            value="{{ request()->input('search') }}">
                        <button type="submit" class="absolute right-3 top-2.5 text-white/50 hover:text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-white/10 text-sky-200">
                            <th class="px-3 py-3 text-left font-medium">No.</th>
                            <th class="px-3 py-3 text-left font-medium">No. SBP</th>
                            <th class="px-4 py-3 text-left font-medium">Tgl SBP</th>
                            <th class="px-4 py-3 text-left font-medium">Lokasi Penindakan</th>
                            <th class="px-4 py-3 text-left font-medium">Pelaku</th>
                            <th class="px-4 py-3 text-left font-medium">Uraian BHP</th>
                            <th class="px-4 py-3 text-left font-medium">Jmlh</th>
                            <th class="px-4 py-3 text-left font-medium">Kemasan</th>
                            <th class="px-4 py-3 text-left font-medium">Nilai Barang</th>
                            <th class="px-4 py-3 text-left font-medium">Potensi Kurang Bayar</th>
                            <th class="px-4 py-3 text-center font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penindakanData as $item)
                        <tr class="border-b border-white/10 hover:bg-white/5 text-black">
                            <td class="px-3 py-3">{{ $item['no'] }}</td>
                            <td class="px-3 py-3">{{ $item['noSBP'] }}</td>
                            <td class="px-4 py-3">{{ $item['tglSBP'] }}</td>
                            <td class="px-4 py-3">{{ $item['lokasiPenindakan'] }}</td>
                            <td class="px-4 py-3">{{ $item['pelaku'] }}</td>
                            <td class="px-4 py-3">{{ $item['uraianBHP'] }}</td>
                            <td class="px-4 py-3">{{ $item['jmlh'] }}</td>
                            <td class="px-4 py-3">{{ $item['kemasan'] }}</td>
                            <td class="px-4 py-3">{{ $item['nilaiBarang'] }}</td>
                            <td class="px-4 py-3">{{ $item['potensiKurangbayar'] }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('intelijen.show', $item['no']) }}"
                                        class="p-2 rounded-lg bg-blue-500 hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    <a href="{{ route('penyidikan.show', $item['no']) }}"
                                        class="p-2 rounded-lg bg-emerald-500 hover:bg-emerald-600 transition-colors">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                    <a href="{{ route('monitoring.show', $item['no']) }}"
                                        class="p-2 rounded-lg bg-purple-500 hover:bg-purple-600 transition-colors">
                                        <i class="fas fa-chart-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-Black py-4">Tidak ada data ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection