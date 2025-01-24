<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        return view('upload.upload');
        $request->validate([
            'option' => 'required',
            'file' => 'required|file|max:2048|mimes:doc,docx,pdf,xls,xlsx,csv,txt,zip',
        ]);
    
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
    
        $filePath = $request->option . '/' . $fileName;
        Storage::disk('public')->put($filePath, file_get_contents($file));
    
        // Save the file information to the database
        // ...
    
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    
        
}