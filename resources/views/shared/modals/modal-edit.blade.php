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
            <input type="hidden" id="edit_no_nhi" name="no_nhi">
            
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
            <input type="hidden" id="edit_no_spdp" name="no_spdp">
            
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
            <input type="hidden" id="edit_no_sbp" name="no_sbp">
            
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
    
    if (editForm) {
        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const section = '{{ $section }}';
            let id;
            
            switch(section) {
                case 'intelijen':
                    id = formData.get('no_nhi');
                    break;
                case 'penyidikan':
                    id = formData.get('no_spdp');
                    break;
                case 'penindakan':
                    id = formData.get('no_sbp');
                    break;
            }
            
            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const response = await fetch(`/${section}/${id}`, {
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