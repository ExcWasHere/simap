@extends('layouts.main')

@section('judul')
    Tambah Data Penyidikan
@endsection

@section('konten')
    <main class="min-h-screen bg-gray-100 pt-20">
        <div class="max-w-7xl mx-auto p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-8">Tambah Data Penyidikan</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 101.414 1.414L10 11.414l1.293 1.293a1 1 001.414-1.414L11.414 10l1.293-1.293a1 1 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <ul class="text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('penyidikan.store') }}" class="space-y-6" id="penyidikan-form">
                    @csrf
                    <input type="hidden" name="entity_type" id="entity_type" value="penyidikan">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            @include('shared.forms.input', [
                                'name' => 'no_spdp',
                                'label' => 'No. SPDP',
                                'type' => 'text',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'tanggal_spdp',
                                'label' => 'Tanggal SPDP',
                                'type' => 'date',
                                'required' => true,
                            ])
                        </div>

                        <div>
                            @include('shared.forms.input', [
                                'name' => 'pelaku',
                                'label' => 'Pelaku',
                                'type' => 'text',
                                'required' => true,
                            ])
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Keterangan
                            </label>
                            <textarea name="penyidikan_keterangan" rows="3"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('penyidikan_keterangan') border-red-500 ring-1 ring-red-500 @enderror">{{ old('penyidikan_keterangan') }}</textarea>
                            @error('penyidikan_keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-8">
                        <a href="{{ url()->previous() }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" id="submit-button"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span id="submit-text">Simpan</span>
                            <span id="submit-spinner" class="hidden"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @push('skrip')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('penyidikan-form');
                const submitButton = document.getElementById('submit-button');
                const submitText = document.getElementById('submit-text');
                const submitSpinner = document.getElementById('submit-spinner');

                form.addEventListener('submit', function() {
                    submitButton.disabled = true;
                    submitText.classList.add('hidden');
                    submitSpinner.classList.remove('hidden');
                });
            });
        </script>
    @endpush
@endsection