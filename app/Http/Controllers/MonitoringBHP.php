<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Request;

class MonitoringBHP extends Controller
{
    public function show()
    {
        return view('pages.monitoring-bhp');
    }

    public function monitoring()
    {
        try {}
        catch (Exception $exception) {}
    }
}