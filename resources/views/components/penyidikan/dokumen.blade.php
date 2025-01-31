@props(['documents', 'no_spdp'])

@include('shared.ui.dokumen', [
    'documents' => $documents,
    'reference_id' => $no_spdp,
    'section' => 'penyidikan'
])