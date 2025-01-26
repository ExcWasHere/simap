<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Request;

class PenyidikanDok extends Controller
{
    public function show()
    {
        return view('pages.dokumen-penyidikan');
    }

    public function monitoring()
    {
        try {}
        catch (Exception $exception) {}
    }
}