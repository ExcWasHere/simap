<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Admin extends Controller
{
    public function show()
    {
        return view('pages.login');
    }

    public function login(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'NIP' => ['required', 'string', 'min:10', 'max:10'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                Log::info('Login successful', ['nip' => $request->NIP]);
                
                return redirect()->route('dashboard')
                    ->with('success', 'Login berhasil!');
            }

            Log::warning('Failed login attempt', ['nip' => $request->NIP]);
            return back()
                ->withErrors(['NIP' => 'NIP atau password salah'])
                ->withInput($request->except('password'));

        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password'));
        } catch (Exception $e) {
            Log::error('Login error:', ['error' => $e->getMessage()]);
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan sistem'])
                ->withInput($request->except('password'));
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('success', 'Berhasil logout!');
    }
}