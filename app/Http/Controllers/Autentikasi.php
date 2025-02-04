<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class Autentikasi extends Controller
{
    /**
     * Views
     */
    public function halaman_beranda(): View
    {
        return view('pages.beranda');
    }

    public function halaman_login(): View
    {
        return view('pages.login');
    }

    public function halaman_lupa_kata_sandi(): View
    {
        return view('pages.lupa-kata-sandi');
    }

    public function halaman_reset_kata_sandi(): View
    {
        return view('pages.reset-kata-sandi');
    }


    /**
     * Controllers
     */
    public function login(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'nip' => ['required', 'string', 'digits:10'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                Log::info('Berhasil masuk ke akun Anda!', ['nip' => $request->nip]);
                return redirect()
                    ->route('dashboard')
                    ->with('success', 'Berhasil masuk ke akun Anda!');
            }

            Log::warning('Upaya masuk gagal dilakukan.', ['nip' => $request->nip]);
            return back()
                ->withErrors(['nip' => 'NIP atau kata sandi salah!'])
                ->withInput($request->except('password'));
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password'));
        } catch (Exception $e) {
            Log::error('Error:', ['error' => $e->getMessage()]);
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan pada sistem.'])
                ->withInput($request->except('password'));
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil keluar dari akun Anda!');
    }

    public function lupa_kata_sandi(Request $request)
    {
        try {
        } catch (Exception $exception) {
            Log::error('Error: ', ['error' => $exception->getMessage()]);
            return back()
                ->withErrors(['error' => "Terjadi kesalahan pada sistem."])
                ->withInput($request->except(''));
        }
    }

    public function reset_kata_sandi(Request $request)
    {
        try {
        } catch (Exception $exception) {
            Log::error('Error: ', ['error' => $exception->getMessage()]);
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan pada sistem.'])
                ->withInput($request->except(''));
        }
    }
}