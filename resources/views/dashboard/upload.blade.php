@extends('layouts.main')

@section('title', 'upload')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold text-gray-900 mb-6">Upload Data</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-6">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('upload.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="option" class="block text-gray-700 font-medium mb-2">Select Option:</label>
            <select name="option" id="option" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500">
                <option value="">-- Select --</option>
                <option value="intelijen">Intelijen</option>
                <option value="penindakan">Penindakan</option>
                <option value="penyidikan">Penyidikan</option>
                <option value="monitoring-bhp">Monitoring BHP</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="file" class="block text-gray-700 font-medium mb-2">Select File:</label>
            <input type="file" name="file" id="file" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg">
            Upload
        </button>
    </form>
</div>
@endsection