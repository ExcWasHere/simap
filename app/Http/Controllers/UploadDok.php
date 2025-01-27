<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Request;

class UploadDok extends Controller
{
    public function show()
    {
        return view('pages.upload-dokumen');
    }

    public function monitoring()
    {
        try {}
        catch (Exception $exception) {}
    }
}