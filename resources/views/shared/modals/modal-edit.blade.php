@php
    $section = $section ?? request()->segment(1);
    $title = match ($section) {
        'intelijen' => 'Edit Data Intelijen',
        'penyidikan' => 'Edit Data Penyidikan',
        'penindakan' => 'Edit Data Penindakan',
        default => 'Edit Data',
    };
@endphp

@component('shared.modals.modal-base', [
    'id_modal' => 'modal_edit',
    'title' => $title,
])
    <form id="edit-form">
        @csrf
        @method('PUT')

        @if ($section === 'intelijen')
            <div data-section="intelijen" class="space-y-4">
                @include('shared.forms.input', [
                    'label' => 'Nomor NHI',
                    'name' => 'no_nhi',
                    'type' => 'text',
                    'id' => 'edit_no_nhi',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Tanggal NHI',
                    'name' => 'tanggal_nhi',
                    'type' => 'date',
                    'id' => 'edit_tanggal_nhi',
                    'data_required' => true,
                ])
                @include('shared.forms.textarea', [
                    'label' => 'Tempat',
                    'name' => 'tempat',
                    'id' => 'edit_tempat',
                    'rows' => 2,
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Jenis Barang',
                    'name' => 'jenis_barang',
                    'type' => 'text',
                    'id' => 'edit_jenis_barang',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Jumlah Barang',
                    'name' => 'jumlah_barang',
                    'type' => 'number',
                    'id' => 'edit_jumlah_barang',
                    'data_required' => true,
                ])
                @include('shared.forms.select', [
                    'label' => 'Kemasan',
                    'name' => 'kemasan',
                    'id' => 'edit_kemasan',
                    'options' => ['liter' => 'Liter', 'batang' => 'Batang'],
                    'data_required' => true,
                ])
                @include('shared.forms.textarea', [
                    'label' => 'Keterangan',
                    'name' => 'keterangan',
                    'id' => 'edit_keterangan',
                    'rows' => 2,
                ])
            </div>
        @endif

        @if ($section === 'penyidikan')
            <div data-section="penyidikan" class="space-y-4">
                @include('shared.forms.input', [
                    'label' => 'No SPDP',
                    'name' => 'no_spdp',
                    'type' => 'text',
                    'id' => 'edit_no_spdp',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Tanggal SPDP',
                    'name' => 'tanggal_spdp',
                    'type' => 'date',
                    'id' => 'edit_tanggal_spdp',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Pelaku',
                    'name' => 'pelaku',
                    'type' => 'text',
                    'id' => 'edit_pelaku',
                    'data_required' => true,
                ])
                @include('shared.forms.textarea', [
                    'label' => 'Keterangan',
                    'name' => 'keterangan',
                    'id' => 'edit_keterangan',
                    'rows' => 3,
                ])
            </div>
        @endif

        @if ($section === 'penindakan')
            <div data-section="penindakan" class="space-y-4">
                @include('shared.forms.input', [
                    'label' => 'Tanggal Laporan',
                    'name' => 'tanggal_laporan',
                    'id' => 'edit_tanggal_laporan',
                    'type' => 'date',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Jenis Barang',
                    'name' => 'jenis_barang',
                    'id' => 'edit_jenis_barang',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'No. SBP',
                    'name' => 'no_sbp',
                    'id' => 'edit_no_sbp',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Tanggal SBP',
                    'name' => 'tanggal_sbp',
                    'id' => 'edit_tanggal_sbp',
                    'type' => 'date',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'No. PRINT',
                    'name' => 'no_print',
                    'id' => 'edit_no_print',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Tanggal PRINT',
                    'name' => 'tanggal_print',
                    'id' => 'edit_tanggal_print',
                    'type' => 'date',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Nama dan Jenis Sarkut',
                    'name' => 'nama_jenis_sarkut',
                    'id' => 'edit_nama_jenis_sarkut',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Pengemudi',
                    'name' => 'pengemudi',
                    'id' => 'edit_pengemudi',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Nomor Polisi',
                    'name' => 'no_polisi',
                    'id' => 'edit_no_polisi',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Bangunan',
                    'name' => 'bangunan',
                    'id' => 'edit_bangunan',
                    'type' => 'text',
                    'data_required' => true,
                ]) @include('shared.forms.input', [
                    'label' => 'Pemilik Bangunan',
                    'name' => 'nama_pemilik',
                    'id' => 'edit_nama_pemilik',
                    'type' => 'text',
                    'data_required' => true,
                ]) @include('shared.forms.input', [
                    'label' => 'Nomor KTP',
                    'name' => 'no_ktp',
                    'id' => 'edit_no_ktp',
                    'type' => 'number',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Pelaku',
                    'name' => 'pelaku',
                    'id' => 'edit_pelaku',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Nomor HP',
                    'name' => 'no_hp',
                    'id' => 'edit_no_hp',
                    'type' => 'number',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Tempat Lahir',
                    'name' => 'tempat_lahir',
                    'id' => 'edit_tempat_lahir',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Tanggal Lahir',
                    'name' => 'tanggal_lahir',
                    'id' => 'edit_tanggal_lahir',
                    'type' => 'date',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Pekerjaan',
                    'name' => 'pekerjaan',
                    'id' => 'edit_pekerjaan',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Alamat',
                    'name' => 'alamat',
                    'id' => 'edit_alamat',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.textarea', [
                    'label' => 'Lokasi Penindakan',
                    'name' => 'lokasi_penindakan',
                    'id' => 'edit_lokasi_penindakan',
                    'rows' => 3,
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Waktu Awal Penindakan',
                    'name' => 'waktu_awal_penindakan',
                    'id' => 'edit_waktu_awal_penindakan',
                    'type' => 'datetime-local',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Waktu Akhir Penindakan',
                    'name' => 'waktu_akhir_penindakan',
                    'id' => 'edit_waktu_akhir_penindakan',
                    'type' => 'datetime-local',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Jenis Pelanggaran',
                    'name' => 'jenis_pelanggaran',
                    'id' => 'edit_jenis_pelanggaran',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Pasal',
                    'name' => 'pasal',
                    'id' => 'edit_pasal',
                    'type' => 'text',
                    'data_required' => true,
                ])
                @include('shared.forms.textarea', [
                    'label' => 'Uraian BHP',
                    'name' => 'uraian_bhp',
                    'id' => 'edit_uraian_bhp',
                    'rows' => 2,
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Jumlah',
                    'name' => 'jumlah',
                    'id' => 'edit_jumlah',
                    'type' => 'number',
                    'data_required' => true,
                ])
                @include('shared.forms.select', [
                    'label' => 'Kemasan',
                    'name' => 'kemasan',
                    'id' => 'edit_kemasan',
                    'options' => [
                        'batang' => 'Batang',
                        'liter' => 'Liter',
                    ],
                ])
                @include('shared.forms.mata-uang', [
                    'label' => 'Perkiraan Nilai Barang',
                    'name' => 'perkiraan_nilai_barang',
                    'id' => 'edit_perkiraan_nilai_barang',
                    'data_required' => true,
                ])
                @include('shared.forms.mata-uang', [
                    'label' => 'Potensi Kurang Bayar',
                    'name' => 'potensi_kurang_bayar',
                    'id' => 'edit_potensi_kurang_bayar',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Petugas 1',
                    'name' => 'petugas_1',
                    'id' => 'edit_petugas_1',
                    'type' => 'name',
                    'data_required' => true,
                ])
                @include('shared.forms.input', [
                    'label' => 'Petugas 2',
                    'name' => 'petugas_2',
                    'id' => 'edit_petugas_2',
                    'type' => 'name',
                    'data_required' => true,
                ])
            </div>
            @include('shared.forms.signature-pad', [
                'label' => 'Tanda Tangan Pelapor',
                'name' => 'ttd_petugas_1',
                'index' => 1,
            ])
            @include('shared.forms.signature-pad', [
                'label' => 'Tanda Tangan Pelaku',
                'name' => 'ttd_petugas_2',
                'index' => 2,
            ])
        @endif
    </form>
@endcomponent

@push('skrip')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.showEditModal = async function(id) {
                try {
                    const section = window.location.pathname.split('/')[1];
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
                    const editForm = document.getElementById('edit-form');
                    if (editForm) {
                        editForm.reset();
                    }

                    window.currentRecordId = id;

                    const formFields = {
                        intelijen: ['no_nhi', 'tanggal_nhi', 'tempat', 'jenis_barang', 'jumlah_barang', 'kemasan', 'keterangan'],
                        penyidikan: ['no_spdp', 'tanggal_spdp', 'pelaku', 'keterangan'],
                        penindakan: ['tanggal_laporan', 'jenis_barang', 'no_sbp', 'tanggal_sbp', 'no_print', 'tanggal_print', 
                            'nama_jenis_sarkut', 'pengemudi', 'no_polisi', 'bangunan', 'nama_pemilik', 'no_ktp', 'pelaku', 
                            'no_hp', 'tempat_lahir', 'tanggal_lahir', 'pekerjaan', 'alamat', 'lokasi_penindakan', 
                            'waktu_awal_penindakan', 'waktu_akhir_penindakan', 'jenis_pelanggaran', 'pasal', 'uraian_bhp', 
                            'jumlah', 'kemasan', 'perkiraan_nilai_barang', 'potensi_kurang_bayar', 'petugas_1', 'petugas_2']
                    };

                    const fields = formFields[section] || [];
                    fields.forEach(field => {
                        const value = recordData[field];
                        if (value !== undefined) {
                            const element = document.getElementById(`edit_${field}`);
                            if (element) {
                                if (element.type === 'datetime-local' && value) {
                                    element.value = new Date(value).toISOString().slice(0, 16);
                                } else if (element.type === 'date' && value) {
                                    element.value = value.split('T')[0];
                                } else {
                                    element.value = value;
                                }
                            }
                        }
                    });

                    if (section === 'penindakan') {
                        setTimeout(() => {
                            if (typeof initializeAllSignaturePads === 'function') {
                                initializeAllSignaturePads();
                            }
                            if (recordData.ttd_petugas_1) {
                                setSignatureData(1, recordData.ttd_petugas_1);
                            }
                            if (recordData.ttd_petugas_2) {
                                setSignatureData(2, recordData.ttd_petugas_2);
                            }
                        }, 100);
                    }

                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal mengambil data: ' + error.message);
                }
            };

            const editForm = document.getElementById('edit-form');
            let currentRecordId = null;

            const isDevelopment = window.location.hostname === 'localhost' ||
                window.location.hostname === '127.0.0.1' ||
                window.location.hostname.includes('.test');

            const debugLog = (message, ...args) => {
                if (isDevelopment) console.log(message, ...args);
            };

            const formElements = {};
            const formFields = {
                intelijen: ['no_nhi', 'tanggal_nhi', 'tempat', 'jenis_barang', 'jumlah_barang', 'kemasan',
                    'keterangan'
                ],
                penyidikan: ['no_spdp', 'tanggal_spdp', 'pelaku', 'keterangan'],
                penindakan: ['tanggal_laporan', 'jenis_barang', 'no_sbp', 'tanggal_sbp', 'no_print',
                    'tanggal_print', 'nama_jenis_sarkut', 'pengemudi', 'no_polisi', 'bangunan',
                    'nama_pemilik', 'no_ktp', 'pelaku', 'no_hp', 'tempat_lahir', 'tanggal_lahir',
                    'pekerjaan', 'alamat', 'lokasi_penindakan', 'waktu_awal_penindakan',
                    'waktu_akhir_penindakan', 'jenis_pelanggaran', 'pasal', 'uraian_bhp', 'jumlah',
                    'kemasan', 'perkiraan_nilai_barang', 'potensi_kurang_bayar', 'petugas_1',
                    'petugas_2'
                ]
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

                    if (editForm) editForm.reset();
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
                    if (element.type === 'datetime-local' && value) {
                        const date = new Date(value);
                        const formattedDate = date.toISOString().slice(0, 16);
                        element.value = formattedDate;
                    } else if (element.type === 'date' && value) {
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
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                    const result = await response.json();
                    const recordData = result.success ? result.data : result;

                    const editModal = document.getElementById('modal_edit');
                    if (!editModal) throw new Error('Modal tidak ditemukan');

                    editModal.classList.remove('hidden');
                    currentRecordId = id;
                    editForm?.reset();

                    const fields = formFields[section] || [];
                    fields.forEach(field => {
                        const value = recordData[field];
                        if (value !== undefined) {
                            setFormValue(`edit_${field}`, value);
                        }
                    });

                    if (section === 'penindakan') {
                        setTimeout(() => {
                            if (typeof initializeAllSignaturePads === 'function') {
                                initializeAllSignaturePads();
                            }

                            if (recordData.ttd_petugas_1) {
                                setSignatureData(1, recordData.ttd_petugas_1);
                            }
                            if (recordData.ttd_petugas_2) {
                                setSignatureData(2, recordData.ttd_petugas_2);
                            }
                        }, 100);
                    }
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
                    
                    if (!window.currentRecordId) {
                        showNotification('ID data tidak valid', 'error');
                        return;
                    }

                    const submitButton = document.querySelector('#submit-edit');
                    const loadingSpinner = document.querySelector('#loading-edit');

                    if (!submitButton || !loadingSpinner) {
                        console.error('Submit button or loading spinner not found');
                        return;
                    }

                    try {
                        submitButton.disabled = true;
                        loadingSpinner.classList.remove('hidden');
                        const buttonText = submitButton.querySelector('span');
                        if (buttonText) buttonText.textContent = 'Menyimpan...';

                        if (typeof saveSignature === 'function') {
                            saveSignature(1);
                            saveSignature(2);
                        }

                        const formData = new FormData(this);
                        const section = window.location.pathname.split('/')[1];
                        const jsonData = Object.fromEntries(formData);

                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        if (!token) throw new Error('CSRF token not found');

                        const response = await fetch(`/${section}/${window.currentRecordId}`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(jsonData)
                        });

                        const result = await response.json();
                        
                        if (!response.ok) {
                            throw new Error(result.message || 'Failed to update data');
                        }

                        if (result.success) {
                            closeEditModal();
                            showNotification('Data berhasil diperbarui', 'success');
                            window.location.reload();
                        } else {
                            throw new Error(result.message || 'Gagal memperbarui data');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification(error.message, 'error');
                    } finally {
                        if (submitButton && loadingSpinner) {
                            submitButton.disabled = false;
                            loadingSpinner.classList.add('hidden');
                            const buttonText = submitButton.querySelector('span');
                            if (buttonText) buttonText.textContent = 'Simpan Perubahan';
                        }
                    }
                });
            }

            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
                const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
                
                notification.className = `fixed bottom-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0`;
                notification.innerHTML = `<div class="flex items-center gap-2"><i class="fas ${icon}"></i> ${message}</div>`;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 500);
                }, 3000);
            }
        });
    </script>
@endpush