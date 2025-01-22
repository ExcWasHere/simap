<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'NIP' => ['required', 'string'],
                'password' => ['required', 'min:6'],
            ]);

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                
                \Log::info('User berhasil login', ['NIP' => $request->NIP]);
                
                return redirect()->intended()
                    ->with('success', 'Login berhasil!');
            }

            \Log::warning('Gagal login', ['NIP' => $request->NIP]);

            return back()
                ->withErrors([
                    'NIP' => 'NIP atau Password yang anda masukan salah.',
                ])
                ->withInput($request->except('password'));

        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password'));
        } catch (\Exception $e) {
            \Log::error('Login error:', ['error' => $e->getMessage()]);
            
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.'])
                ->withInput($request->except('password'));
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')
                ->with('success', 'Anda telah berhasil logout.');
        } catch (\Exception $e) {
            \Log::error('Logout error:', ['error' => $e->getMessage()]);
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat logout.']);
        }
    }
}
