@component('shared.ui.modal-base', [
    'id_modal' => 'modal_detail',
    'title' => 'Detail Data'
])
    @include('shared.ui.navigation', [
        'tabs' => [
            ['id' => 'penindakan', 'label' => 'Penindakan', 'active' => true],
            ['id' => 'penyidikan', 'label' => 'Penyidikan'],
            ['id' => 'intelijen', 'label' => 'Intelijen']
        ]
    ])

    <div class="tab-content active" id="penindakan-content">
        <div class="grid grid-cols-1 gap-6">
            <div class="h-full flex flex-col space-y-4">
                @include('shared.forms.detail-item', [
                    'label' => 'No. SBP',
                    'value' => '123456'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Lokasi Penindakan',
                    'value' => 'DSN DOKO RT 01 RW 01, KALIANYAR, KEC. KALIANYAR, KAB. BLITAR'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Uraian BHP',
                    'value' => 'ROKOK SMTH ILEGAL'
                ])

                @include('shared.forms.detail-item', [
                    'label' => 'Jumlah',
                    'value' => '20 (DUA PULUH) BAL'
                ])
            </div>
            <div class="h-full flex flex-col space-y-4">
                @include('shared.forms.detail-item', [
                    'label' => 'Tanggal SBP',
                    'value' => '22-09-2024'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Pelaku',
                    'value' => 'AGUS RIMBA'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Nilai Barang',
                    'value' => 'Rp 10.000.000 (SEPULUH JUTA RUPIAH)'
                ])

                @include('shared.forms.detail-item', [
                    'label' => 'Potensi Kurang Bayar',
                    'value' => '-'
                ])
            </div>
        </div>
    </div>

    <div class="tab-content hidden" id="penyidikan-content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                @include('shared.forms.detail-item', [
                    'label' => 'No. SPDP',
                    'value' => '123456'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Pelaku',
                    'value' => 'AGUS RIMBA'
                ])
            </div>
            <div class="space-y-4">
                @include('shared.forms.detail-item', [
                    'label' => 'Tanggal SPDP',
                    'value' => '22-09-2024'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Keterangan',
                    'value' => 'BERHASIL DIAMANKAN'
                ])
            </div>
        </div>
    </div>

    <div class="tab-content hidden" id="intelijen-content">
        <div class="grid grid-cols-1 gap-6">
            <div class="space-y-4">
                @include('shared.forms.detail-item', [
                    'label' => 'No. NHI',
                    'value' => '123456'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Tempat',
                    'value' => 'DSN DOKO RT 01 RW 01, KALIANYAR, KEC. KALIANYAR, KAB. BLITAR'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Jumlah Barang',
                    'value' => '20 (DUA PULUH) BAL'
                ])
            </div>
            <div class="space-y-4">
                @include('shared.forms.detail-item', [
                    'label' => 'Tanggal NHI',
                    'value' => '22-09-2024'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Jenis',
                    'value' => 'ROKOK SMTH ILEGAL'
                ])
                
                @include('shared.forms.detail-item', [
                    'label' => 'Keterangan',
                    'value' => '-'
                ])
            </div>
        </div>
    </div>
@endcomponent

