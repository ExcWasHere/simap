<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Request;

class IntelijenDok extends Controller
{
    public function show()
    {
        return view('pages.dokumen-intelijen');
    }

    public function monitoring()
    {
        try {}
        catch (Exception $exception) {}
    }
}