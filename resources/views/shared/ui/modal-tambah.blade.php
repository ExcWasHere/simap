@php
    $activeTab = old('entity_type', 'penindakan');
@endphp

@component('shared.ui.modal-base', [
    'id_modal' => 'modal_tambah',
    'title' => 'Tambah Data',
])
    <form id="formulir-tambah-data" class="space-y-6" method="POST" 
        action="{{ route('data.store') }}"
        x-data="{ entityType: '{{ old('entity_type', 'penindakan') }}' }"
        x-ref="form">
        @csrf
        <input type="hidden" name="entity_type" id="entity_type" value="{{old('entity_type', 'penindakan')}}">
        @include('shared.ui.navigation', [
            'tabs' => [
                ['id' => 'penindakan', 'label' => 'Penindakan', 'active' => true],
                ['id' => 'penyidikan', 'label' => 'Penyidikan'],
                ['id' => 'intelijen', 'label' => 'Intelijen'],
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

        {{-- Penindakan --}}    
        <section class="tab-content active grid grid-cols-1 gap-6" id="penindakan-content">
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
            @include('shared.forms.input', [
                'label' => 'Pelaku',
                'name' => 'penindakan_pelaku',
                'type' => 'text',
                'data_required' => true,
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
        </section>

        {{-- Penyidikan --}}
        <section class="tab-content hidden" id="penyidikan-content">
            <div class="grid grid-cols-1 gap-6">
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

                @include('shared.forms.select', [
                    'label' => 'Penindakan Terkait',
                    'name' => 'penindakan_id',
                    'options' => App\Models\Penindakan::pluck('no_sbp', 'id'),
                    'data_required' => true
                ])
                @include('shared.forms.textarea', [
                    'label' => 'Keterangan',
                    'name' => 'penyidikan_keterangan',
                    'rows' => 3
                ])
            </div>
        </section>

        {{-- Intelijen --}}
        <section class="tab-content hidden" id="intelijen-content">
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
    </form>
@endcomponent