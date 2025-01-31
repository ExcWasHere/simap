@props(['documents', 'no_nhi'])

@include('shared.ui.dokumen', [
    'documents' => $documents,
    'reference_id' => $no_nhi,
    'section' => 'intelijen'
])