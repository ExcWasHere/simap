@php
    $section = $section ?? request()->segment(1);
    $title = match($section) {
        'intelijen' => 'Edit Data Intelijen',
        'penyidikan' => 'Edit Data Penyidikan',
        'penindakan' => 'Edit Data Penindakan',
        default => 'Edit Data'
    };
@endphp

@component('shared.modals.modal-base', [
    'id_modal' => 'modal_edit',
    'title' => $title
])
    <form id="edit-form" class="space-y-4">
        @csrf
        @method('PUT')
        
        @if($section === 'intelijen')
            @include('shared.forms.input', [
                'label' => 'Nomor NHI',
                'name' => 'no_nhi',
                'type' => 'text',
                'id' => 'edit_no_nhi',
                'data_required' => true
            ])
            
            <div class="text-sm text-amber-600 bg-amber-50 p-3 rounded-lg mb-4">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Perubahan nomor NHI akan memperbarui semua referensi terkait di Penyidikan dan Penindakan.
            </div>
            
            @include('shared.forms.input', [
                'label' => 'Tanggal NHI',
                'name' => 'tanggal_nhi',
                'type' => 'date',
                'id' => 'edit_tanggal_nhi',
                'data_required' => true
            ])

            @include('shared.forms.textarea', [
                'label' => 'Tempat',
                'name' => 'tempat',
                'id' => 'edit_tempat',
                'rows' => 2,
                'data_required' => true
            ])

            @include('shared.forms.input', [
                'label' => 'Jenis Barang',
                'name' => 'jenis_barang',
                'type' => 'text',
                'id' => 'edit_jenis_barang',
                'data_required' => true
            ])

            @include('shared.forms.input', [
                'label' => 'Jumlah Barang',
                'name' => 'jumlah_barang',
                'type' => 'number',
                'id' => 'edit_jumlah_barang',
                'data_required' => true
            ])

            @include('shared.forms.textarea', [
                'label' => 'Keterangan',
                'name' => 'keterangan',
                'id' => 'edit_keterangan',
                'rows' => 2
            ])
        @endif

        @if($section === 'penyidikan')
            @include('shared.forms.input', [
                'label' => 'No SPDP',
                'name' => 'no_spdp',
                'type' => 'text',
                'id' => 'edit_no_spdp',
                'data_required' => true
            ])
            
            @include('shared.forms.input', [
                'label' => 'Tanggal SPDP',
                'name' => 'tanggal_spdp',
                'type' => 'date',
                'id' => 'edit_tanggal_spdp',
                'data_required' => true
            ])

            @include('shared.forms.input', [
                'label' => 'Pelaku',
                'name' => 'pelaku',
                'type' => 'text',
                'id' => 'edit_pelaku',
                'data_required' => true
            ])

            @include('shared.forms.select', [
                'label' => 'Intelijen Terkait',
                'name' => 'intelijen_id',
                'id' => 'edit_intelijen_id',
                'options' => App\Models\Intelijen::pluck('no_nhi', 'id'),
                'data_required' => true
            ])

            @include('shared.forms.textarea', [
                'label' => 'Keterangan',
                'name' => 'keterangan',
                'id' => 'edit_keterangan',
                'rows' => 3
            ])
        @endif

        @if($section === 'penindakan')
            @include('shared.forms.input', [
                'label' => 'No SBP',
                'name' => 'no_sbp',
                'type' => 'text',
                'id' => 'edit_no_sbp',
                'data_required' => true
            ])
            
            @include('shared.forms.input', [
                'label' => 'Tanggal SBP',
                'name' => 'tanggal_sbp',
                'type' => 'date',
                'id' => 'edit_tanggal_sbp',
                'data_required' => true
            ])

            @include('shared.forms.select', [
                'label' => 'Penyidikan Terkait',
                'name' => 'penyidikan_id',
                'id' => 'edit_penyidikan_id',
                'options' => App\Models\Penyidikan::pluck('no_spdp', 'id'),
                'data_required' => true
            ])

            @include('shared.forms.textarea', [
                'label' => 'Lokasi Penindakan',
                'name' => 'lokasi_penindakan',
                'id' => 'edit_lokasi_penindakan',
                'rows' => 3,
                'data_required' => true
            ])

            @include('shared.forms.textarea', [
                'label' => 'Uraian BHP',
                'name' => 'uraian_bhp',
                'id' => 'edit_uraian_bhp',
                'rows' => 2,
                'data_required' => true
            ])

            @include('shared.forms.input', [
                'label' => 'Jumlah',
                'name' => 'jumlah',
                'type' => 'number',
                'id' => 'edit_jumlah',
                'data_required' => true
            ])

            @include('shared.forms.input', [
                'label' => 'Kemasan',
                'name' => 'kemasan',
                'type' => 'text',
                'id' => 'edit_kemasan',
                'data_required' => true
            ])

            @include('shared.forms.currency-input', [
                'label' => 'Perkiraan Nilai Barang',
                'name' => 'perkiraan_nilai_barang',
                'id' => 'edit_perkiraan_nilai_barang',
                'data_required' => true
            ])

            @include('shared.forms.currency-input', [
                'label' => 'Potensi Kurang Bayar',
                'name' => 'potensi_kurang_bayar',
                'id' => 'edit_potensi_kurang_bayar',
                'data_required' => true
            ])
        @endif
    </form>
@endcomponent

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('edit-form');
    let currentRecordId = null;
    
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', async function() {
            const id = this.dataset.id;
            currentRecordId = id;
            const section = window.location.pathname.split('/')[1] || 'penindakan';
            
            try {
                const response = await fetch(`/${section}/${id}/edit`);
                if (!response.ok) throw new Error('Failed to fetch data');
                
                const data = await response.json();
                const editModal = document.getElementById('modal_edit');
                if (!editModal) {
                    throw new Error('Modal tidak ditemukan');
                }
                editModal.classList.remove('hidden');

                switch(section) {
                    case 'penindakan':
                        // Update penyidikan select options if they exist in response
                        if (data.penyidikanOptions) {
                            const penyidikanSelect = document.getElementById('edit_penyidikan_id');
                            if (penyidikanSelect) {
                                // Clear existing options except the first one (placeholder)
                                while (penyidikanSelect.options.length > 1) {
                                    penyidikanSelect.remove(1);
                                }
                                // Add new options
                                Object.entries(data.penyidikanOptions).forEach(([id, noSpdp]) => {
                                    const option = new Option(noSpdp, id);
                                    penyidikanSelect.add(option);
                                });
                            }
                        }

                        const penindakanFields = {
                            'edit_no_sbp': data.no_sbp,
                            'edit_tanggal_sbp': data.tanggal_sbp.split(' ')[0],
                            'edit_penyidikan_id': data.penyidikan_id,
                            'edit_lokasi_penindakan': data.lokasi_penindakan,
                            'edit_uraian_bhp': data.uraian_bhp,
                            'edit_jumlah': data.jumlah,
                            'edit_kemasan': data.kemasan,
                            'edit_perkiraan_nilai_barang': data.perkiraan_nilai_barang,
                            'edit_potensi_kurang_bayar': data.potensi_kurang_bayar
                        };
                        Object.entries(penindakanFields).forEach(([id, value]) => {
                            const element = document.getElementById(id);
                            if (element) element.value = value;
                        });
                        break;

                    case 'penyidikan':
                        const penyidikanFields = {
                            'edit_no_spdp': data.no_spdp,
                            'edit_tanggal_spdp': data.tanggal_spdp.split(' ')[0],
                            'edit_pelaku': data.pelaku,
                            'edit_intelijen_id': data.intelijen_id,
                            'edit_keterangan': data.keterangan || ''
                        };
                        Object.entries(penyidikanFields).forEach(([id, value]) => {
                            const element = document.getElementById(id);
                            if (element) element.value = value;
                        });
                        break;
                }
                
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal mengambil data: ' + error.message);
            }
        });
    });
    
    if (editForm) {
        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!currentRecordId) {
                alert('Error: ID record tidak ditemukan');
                return;
            }

            const formData = new FormData(this);
            const section = '{{ $section }}';
            
            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const response = await fetch(`/${section}/${currentRecordId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });
                
                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Failed to update data');
                }
                
                const result = await response.json();
                
                if (result.success) {
                    document.getElementById('modal_edit').classList.add('hidden');
                    
                    const notification = document.createElement('div');
                    notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0';
                    notification.innerHTML = '<div class="flex items-center gap-2"><i class="fas fa-check-circle"></i> Data berhasil diperbarui</div>';
                    document.body.appendChild(notification);
                    
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        setTimeout(() => notification.remove(), 500);
                    }, 3000);
                    
                    window.location.reload();
                } else {
                    throw new Error(result.message || 'Gagal memperbarui data');
                }
                
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memperbarui data: ' + error.message);
            }
        });
    }
});
</script>
@endpush 