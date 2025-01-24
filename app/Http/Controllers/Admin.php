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

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'nip' => ['required', 'number'],
                'password' => ['required', 'min:8'],
            ]);
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                Log::info('Proses login berhasil dilakukan.', ['nip' => $request->nip]);
                return redirect()->intended()->with('success', 'Berhasil login!');
            }
            Log::warning('Gagal login, periksa kembali data pribadi Anda.', ['nip' => $request->nip]);
            return back()
                ->withErrors(['nip' => 'NIP yang Anda loginkan salah!'])
                ->withInput($request->except('password'));
        } catch (ValidationException $validate) {
            return back()
                ->withErrors($validate->errors())
                ->withInput($request->except('password'));
        } catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['error' => $exception->getMessage()]);
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat proses login, harap coba lagi nanti!'])
                ->withInput($request->except('password'));
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('success', 'Pengguna berhasil logout dari akun.');
        }
        catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['error' => $exception->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat logout.']);
        }
    }
}