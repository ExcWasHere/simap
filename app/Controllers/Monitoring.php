<?php

namespace App\Controllers;

use Exception;
use Illuminate\Support\Facades\Request;

class Monitoring extends Controller
{
    public function show()
    {
        return view('pages.monitoring');
    }

    public function monitoring()
    {
        try {
        } catch (Exception $exception) {
        }
    }
}