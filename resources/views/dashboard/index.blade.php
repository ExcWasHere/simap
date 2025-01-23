@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-2">
    <h1 class="text-3xl font-semibold text-gray-900 mb-2">Dashboard</h1>
    
    <div class="bg-blue-50 border-l-4 border-gray-400 p-4 mb-3">
        <p class="text-gray-700">
            Selamat datang di SIMAP (Sistem Informasi Manajemen Intelijen dan Pengawasan). Aplikasi ini membantu Anda mengelola, menyimpan, dan mengakses data intelijen dan pengawasan secara digital dengan aman dan efisien.
        </p>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex items-center gap-6">
                <div class="flex-shrink-0 bg-gray-100 rounded-full p-4">
                    <i class="fas fa-user-circle text-5xl text-[#1a4167] hover:text-gray-600 transition-colors"></i>
                </div>
                <div class="flex-grow">
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Informasi Akun</h2>
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-700">
                            <span class="w-24 font-medium">Nama:</span>
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <span class="w-24 font-medium">NIP:</span>
                            <span>{{ auth()->user()->NIP }}</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <span class="w-24 font-medium">Email:</span>
                            <span>{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="bg-blue-100 rounded-lg p-3">
                    <i class="fas fa-search text-2xl text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Intelijen</h3>
                    <p class="text-sm text-gray-600">Manajemen data intelijen dan pengawasan</p>
                </div>
            </div>
            <a href="/intelijen" class="mt-4 inline-block w-full text-center py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                Akses Menu
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="bg-orange-100 rounded-lg p-3">
                    <i class="fas fa-shield-alt text-2xl text-orange-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Penindakan</h3>
                    <p class="text-sm text-gray-600">Sistem penindakan dan penegakan hukum</p>
                </div>
            </div>
            <a href="/penindakan" class="mt-4 inline-block w-full text-center py-2 bg-orange-50 text-orange-600 rounded-lg hover:bg-orange-100 transition-colors">
                Akses Menu
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="bg-emerald-100 rounded-lg p-3">
                    <i class="fas fa-file-alt text-2xl text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Penyidikan</h3>
                    <p class="text-sm text-gray-600">Proses penyidikan dan dokumentasi</p>
                </div>
            </div>
            <a href="/penyidikan" class="mt-4 inline-block w-full text-center py-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors">
                Akses Menu
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center gap-4">
                <div class="bg-purple-100 rounded-lg p-3">
                    <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Monitoring BHP</h3>
                    <p class="text-sm text-gray-600">Pengawasan Barang Hasil Penindakan</p>
                </div>
            </div>
            <a href="/monitoring-bhp" class="mt-4 inline-block w-full text-center py-2 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition-colors">
                Akses Menu
            </a>
        </div>
    </div>
</div>
@endsection