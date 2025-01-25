@component('shared.ui.modal-base', [
    'modalId' => 'modalTambah',
    'title' => 'Tambah Data'
])
    <form id="formTambahData" class="space-y-6">
        @include('shared.ui.navigation', [
            'tabs' => [
                ['id' => 'penindakan', 'label' => 'Penindakan', 'active' => true],
                ['id' => 'penyidikan', 'label' => 'Penyidikan'],
                ['id' => 'intelijen', 'label' => 'Intelijen']
            ]
        ])

        <div class="tab-content active" id="penindakan-content">
            <div class="grid grid-cols-1 gap-6">
                <div class="space-y-4">
                    @include('shared.forms.input', [
                        'label' => 'No. SBP',
                        'name' => 'no_sbp',
                        'type' => 'text'
                    ])
                    
                    @include('shared.forms.textarea', [
                        'label' => 'Lokasi Penindakan',
                        'name' => 'lokasi_penindakan',
                        'rows' => 3
                    ])
                    
                    @include('shared.forms.textarea', [
                        'label' => 'Uraian BHP',
                        'name' => 'uraian_bhp',
                        'rows' => 2
                    ])

                    @include('shared.forms.input', [
                        'label' => 'Kemasan',
                        'name' => 'kemasan',
                        'type' => 'text'
                    ])
                </div>

                <div class="space-y-4">
                    @include('shared.forms.input', [
                        'label' => 'Tanggal SBP',
                        'name' => 'tanggal_sbp',
                        'type' => 'date'
                    ])
                    
                    @include('shared.forms.input', [
                        'label' => 'Pelaku',
                        'name' => 'pelaku',
                        'type' => 'text'
                    ])
                    
                    @include('shared.forms.currency-input', [
                        'label' => 'Perkiraan Nilai Barang',
                        'name' => 'perkiraan_nilai_barang'
                    ])

                    @include('shared.forms.currency-input', [
                        'label' => 'Potensi Kurang Bayar',
                        'name' => 'potensi_kurang_bayar'
                    ])
                </div>
            </div>
        </div>

        <div class="tab-content hidden" id="penyidikan-content">
            <div class="grid grid-cols-1 gap-6">
                <div class="space-y-4">
                    @include('shared.forms.input', [
                        'label' => 'No. SPDP',
                        'name' => 'no_spdp',
                        'type' => 'text'
                    ])
                    
                    @include('shared.forms.input', [
                        'label' => 'Pelaku',
                        'name' => 'pelaku_penyidikan',
                        'type' => 'text'
                    ])
                </div>

                <div class="space-y-4">
                    @include('shared.forms.input', [
                        'label' => 'Tanggal SPDP',
                        'name' => 'tanggal_spdp',
                        'type' => 'date'
                    ])
                    
                    @include('shared.forms.textarea', [
                        'label' => 'Keterangan',
                        'name' => 'keterangan',
                        'rows' => 3
                    ])
                </div>
            </div>
        </div>

        <div class="tab-content hidden" id="intelijen-content">
            <div class="grid grid-cols-1 gap-6">
                <div class="space-y-4">
                    @include('shared.forms.input', [
                        'label' => 'No. NHI',
                        'name' => 'no_nhi',
                        'type' => 'text'
                    ])
                    
                    @include('shared.forms.textarea', [
                        'label' => 'Tempat',
                        'name' => 'tempat',
                        'rows' => 2
                    ])
                    
                    @include('shared.forms.input', [
                        'label' => 'Jumlah Barang',
                        'name' => 'jumlah_barang',
                        'type' => 'text'
                    ])
                </div>

                <div class="space-y-4">
                    @include('shared.forms.input', [
                        'label' => 'Tanggal NHI',
                        'name' => 'tanggal_nhi',
                        'type' => 'date'
                    ])
                    
                    @include('shared.forms.input', [
                        'label' => 'Jenis Barang',
                        'name' => 'jenis_barang',
                        'type' => 'text'
                    ])
                    
                    @include('shared.forms.textarea', [
                        'label' => 'Keterangan',
                        'name' => 'keterangan',
                        'rows' => 2
                    ])
                </div>
            </div>
        </div>
    </form>
@endcomponent

