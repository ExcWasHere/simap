@props(['documents', 'no_sbp'])

@include('shared.ui.dokumen', [
    'documents' => $documents,
    'reference_id' => $no_sbp,
    'section' => 'penindakan'
])