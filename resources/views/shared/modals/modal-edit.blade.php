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
            <div data-section="intelijen">
                @include('shared.forms.input', [
                    'label' => 'Nomor NHI',
                    'name' => 'no_nhi',
                    'type' => 'text',
                    'id' => 'edit_no_nhi',
                    'data_required' => true
                ])
                
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

                @include('shared.forms.select', [
                    'label' => 'Kemasan',
                    'name' => 'kemasan',
                    'id' => 'edit_kemasan',
                    'options' => ['liter' => 'Liter', 'batang' => 'Batang'],
                    'data_required' => true
                ])

                @include('shared.forms.textarea', [
                    'label' => 'Keterangan',
                    'name' => 'keterangan',
                    'id' => 'edit_keterangan',
                    'rows' => 2
                ])
            </div>
        @endif

        @if($section === 'penyidikan')
            <div data-section="penyidikan">
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

                @include('shared.forms.textarea', [
                    'label' => 'Keterangan',
                    'name' => 'keterangan',
                    'id' => 'edit_keterangan',
                    'rows' => 3
                ])
            </div>
        @endif

        @if($section === 'penindakan')
            <div data-section="penindakan">
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

                @include('shared.forms.input', [
                    'label' => 'Pelaku',
                    'name' => 'pelaku',
                    'type' => 'text',
                    'id' => 'edit_pelaku',
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

                @include('shared.forms.mata-uang', [
                    'label' => 'Perkiraan Nilai Barang',
                    'name' => 'perkiraan_nilai_barang',
                    'id' => 'edit_perkiraan_nilai_barang',
                    'data_required' => true
                ])

                @include('shared.forms.mata-uang', [
                    'label' => 'Potensi Kurang Bayar',
                    'name' => 'potensi_kurang_bayar',
                    'id' => 'edit_potensi_kurang_bayar',
                    'data_required' => true
                ])
            </div>
        @endif

    </form>
@endcomponent

@push('skrip')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('edit-form');
    let currentRecordId = null;
    
    const isDevelopment = window.location.hostname === 'localhost' || 
                         window.location.hostname === '127.0.0.1' ||
                         window.location.hostname.includes('.test');
    
    const debugLog = (message, ...args) => {
        if (isDevelopment) {
            console.log(message, ...args);
        }
    };

    const formElements = {};
    const formFields = {
        intelijen: ['no_nhi', 'tanggal_nhi', 'tempat', 'jenis_barang', 'jumlah_barang', 'kemasan', 'keterangan'],
        penyidikan: ['no_spdp', 'tanggal_spdp', 'pelaku', 'keterangan'],
        penindakan: ['no_sbp', 'tanggal_sbp', 'pelaku', 'lokasi_penindakan', 'uraian_bhp', 'jumlah', 'kemasan', 'perkiraan_nilai_barang', 'potensi_kurang_bayar']
    };

    Object.values(formFields).flat().forEach(field => {
        const id = `edit_${field}`;
        formElements[field] = document.getElementById(id);
    });
    
    window.closeEditModal = function() {
        const editModal = document.getElementById('modal_edit');
        if (editModal) {
            editModal.classList.add('hidden');
            editModal.style.display = '';
            
            if (editForm) {
                editForm.reset();
            }
        }
    };
    
    const setFormValue = (id, value) => {
        const fieldName = id.replace('edit_', '');
        const element = formElements[fieldName] || document.getElementById(id);
        
        if (!element) {
            debugLog(`Element with id ${id} not found`);
            return;
        }

        try {
            if (element.type === 'date' && value) {
                element.value = value.split('T')[0];
            } else if (element.type === 'number') {
                element.value = value || 0;
            } else if (element.classList.contains('mata-uang')) {
                element.value = value || 0;
                element.dispatchEvent(new Event('change'));
            } else if (element.tagName === 'SELECT') {
                if (value) element.value = value;
            } else {
                element.value = value || '';
            }

            debugLog(`Set ${id} to:`, element.value);
        } catch (error) {
            debugLog(`Error setting value for ${id}:`, error);
        }
    };

    const setSelectOptions = (selectId, options, selectedValue) => {
        const select = document.getElementById(selectId);
        if (!select) return;

        const firstOption = select.options[0];
        select.innerHTML = '';
        if (firstOption) select.add(firstOption);

        if (options) {
            Object.entries(options).forEach(([value, text]) => {
                const option = new Option(text, value);
                select.add(option);
            });
        }
        
        if (selectedValue) {
            select.value = selectedValue;
            debugLog(`Selected value for ${selectId}:`, selectedValue);
        }
    };

    const showEditModal = async (id, section) => {
        try {
            debugLog('Editing record:', { id, section });

            const response = await fetch(`/${section}/${id}/edit`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            const recordData = result.success ? result.data : result;

            const editModal = document.getElementById('modal_edit');
            if (!editModal) {
                throw new Error('Modal tidak ditemukan');
            }

            editModal.classList.remove('hidden');
            currentRecordId = id;
            
            editForm?.reset();

            const sectionElement = editForm?.querySelector(`[data-section="${section}"]`);
            if (sectionElement?.classList.contains('hidden')) {
                sectionElement.classList.remove('hidden');
            }

            const fields = formFields[section] || [];
            fields.forEach(field => {
                const value = recordData[field];
                if (value !== undefined) {
                    setFormValue(`edit_${field}`, value);
                }
            });

        } catch (error) {
            console.error('Error:', error);
            alert('Gagal mengambil data: ' + error.message);
        }
    };

    document.addEventListener('click', function(e) {
        if (e.target.matches('.edit-btn')) {
            const id = e.target.dataset.id;
            currentRecordId = id;
            const section = window.location.pathname.split('/')[1];
            showEditModal(id, section);
        }
    });

    if (editForm) {
        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!currentRecordId) {
                alert('Error: ID record tidak ditemukan');
                return;
            }

            const formData = new FormData(this);
            const section = window.location.pathname.split('/')[1];
            
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
                    closeEditModal();
                    
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