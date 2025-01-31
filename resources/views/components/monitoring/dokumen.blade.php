@props(['documents', 'id'])

@include('shared.ui.dokumen', [
    'documents' => $documents,
    'reference_id' => $id,
    'section' => 'monitoring'
])