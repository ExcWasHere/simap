<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Request;

class MonitoringDok extends Controller
{
    public function show()
    {
        return view('pages.dokumen-monitoring');
    }

    public function monitoring()
    {
        try {}
        catch (Exception $exception) {}
    }
}