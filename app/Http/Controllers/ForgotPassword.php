<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class ForgotPassword extends Controller
{
    public function show()
    {
        return view('pages.lupa-kata-sandi');
    }

    public function forgot_password(Request $request)
    {
        try {}
        catch(Exception $e) {
            Log::error('Error: ', ['error' => $e->getMessage()]);
            return back()
                ->withErrors(['error' => "Terjadi kesalahan sistem!"])
                ->withInput($request->except(''));
        }
    }
}