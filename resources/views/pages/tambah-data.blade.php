@component('layouts.main', [
    'judul' => 'Tambah Data',
    'deskripsi' => '',
])
@php
    $activeTab = old('entity_type', 'intelijen');
@endphp
<div class="py-6 pt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Data</h1>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="py-4">
            <div class="bg-white shadow rounded-lg p-6">
                <form id="formulir-tambah-data" class="space-y-6" method="POST" action="{{ route('data.store') }}">
                    @csrf
                    <input type="hidden" name="entity_type" id="entity_type" value="{{ $activeTab }}">

                    @include('shared.ui.navigation', [
    'tabs' => [
        ['id' => 'intelijen', 'label' => 'Intelijen', 'active' => $activeTab === 'intelijen'],
        ['id' => 'penyidikan', 'label' => 'Penyidikan', 'active' => $activeTab === 'penyidikan'],
        ['id' => 'penindakan', 'label' => 'Penindakan', 'active' => $activeTab === 'penindakan'],
    ],
])

                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-lg">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Intelijen --}}
                    <section class="tab-content {{ $activeTab === 'intelijen' ? 'active' : 'hidden' }}"
                        id="intelijen-content" data-content="intelijen">
                        <div class="grid grid-cols-1 gap-6">
                            @include('shared.forms.input', [
    'label' => 'No. NHI',
    'name' => 'no_nhi',
    'type' => 'text',
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'Tanggal NHI',
    'name' => 'tanggal_nhi',
    'type' => 'date',
    'data_required' => true
])
                            @include('shared.forms.textarea', [
    'label' => 'Tempat',
    'name' => 'tempat',
    'rows' => 2,
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'Jenis Barang',
    'name' => 'jenis_barang',
    'type' => 'text',
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'Jumlah Barang',
    'name' => 'jumlah_barang',
    'type' => 'number',
    'data_required' => true
])
                            @include('shared.forms.textarea', [
    'label' => 'Keterangan',
    'name' => 'intelijen_keterangan',
    'rows' => 2
])
                        </div>
                    </section>

                    {{-- Penyidikan --}}
                    <section class="tab-content {{ $activeTab === 'penyidikan' ? 'active' : 'hidden' }}"
                        id="penyidikan-content" data-content="penyidikan">
                        <div class="grid grid-cols-1 gap-6">
                            @include('shared.forms.select', [
    'label' => 'Intelijen Terkait',
    'name' => 'intelijen_id',
    'options' => App\Models\Intelijen::pluck('no_nhi', 'id'),
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'No. SPDP',
    'name' => 'no_spdp',
    'type' => 'text',
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'Tanggal SPDP',
    'name' => 'tanggal_spdp',
    'type' => 'date',
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'Pelaku',
    'name' => 'pelaku',
    'type' => 'text',
    'data_required' => true
])
                            @include('shared.forms.textarea', [
    'label' => 'Keterangan',
    'name' => 'penyidikan_keterangan',
    'rows' => 3
])
                        </div>
                    </section>

                    {{-- Penindakan --}}
                    <section class="tab-content {{ $activeTab === 'penindakan' ? 'active' : 'hidden' }}"
                        id="penindakan-content" data-content="penindakan">
                        <div class="grid grid-cols-1 gap-6">
                            @include('shared.forms.select', [
    'label' => 'Penyidikan Terkait',
    'name' => 'penyidikan_id',
    'options' => App\Models\Penyidikan::pluck('no_spdp', 'id'),
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'No. SBP',
    'name' => 'no_sbp',
    'type' => 'text',
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'Tanggal SBP',
    'name' => 'tanggal_sbp',
    'type' => 'date',
    'data_required' => true
])
                            @include('shared.forms.textarea', [
    'label' => 'Lokasi Penindakan',
    'name' => 'lokasi_penindakan',
    'rows' => 3,
    'data_required' => true
])
                            @include('shared.forms.textarea', [
    'label' => 'Uraian BHP',
    'name' => 'uraian_bhp',
    'rows' => 2,
    'data_required' => true
])
                            @include('shared.forms.input', [
    'label' => 'Jumlah',
    'name' => 'jumlah',
    'type' => 'number',
    'data_required' => true
])
                            @include('shared.forms.currency-input', [
    'label' => 'Perkiraan Nilai Barang',
    'name' => 'perkiraan_nilai_barang',
    'data_required' => true
])
                            @include('shared.forms.currency-input', [
    'label' => 'Potensi Kurang Bayar',
    'name' => 'potensi_kurang_bayar',
    'data_required' => true
])
                        </div>
                    </section>


                    <div class="flex justify-end space-x-3 pt-6">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('[data-tab]');
        const contents = document.querySelectorAll('.tab-content');
        const entityInput = document.getElementById('entity_type');

        function activateTab(tabId) {
            if (entityInput) {
                entityInput.value = tabId;
            }

            tabs.forEach(tab => {
                const currentTabId = tab.getAttribute('data-tab');
                if (currentTabId === tabId) {
                    tab.classList.add('border-blue-500', 'text-blue-600');
                    tab.classList.remove('border-transparent', 'text-gray-500');
                } else {
                    tab.classList.remove('border-blue-500', 'text-blue-600');
                    tab.classList.add('border-transparent', 'text-gray-500');
                }
            });

            contents.forEach(content => {
                const contentId = content.getAttribute('data-content');
                if (contentId === tabId) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const tabId = this.getAttribute('data-tab');
                activateTab(tabId);
            });
        });

        const initialTab = document.querySelector('[data-tab][aria-selected="true"]');
        if (initialTab) {
            activateTab(initialTab.getAttribute('data-tab'));
        }
    });
</script>
@endpush
@endcomponent