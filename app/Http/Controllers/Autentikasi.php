<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

    public function halaman_masuk(): View
    {
        return view('pages.masuk');
    }

    public function halaman_lupa_kata_sandi(): View
    {
        return view('pages.lupa-kata-sandi');
    }

    public function halaman_reset_kata_sandi(Request $request): View
    {
        $token = $request->route('token');
        $nip = $request->query('nip');
        return view('pages.reset-kata-sandi', ['token' => $token, 'nip' => $nip]);
    }


    /**
     * Controllers
     */
    public function masuk(Request $request): RedirectResponse
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

    public function keluar(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('masuk')
            ->with('success', 'Berhasil keluar dari akun Anda!');
    }

    public function lupa_kata_sandi(Request $request)
    {
        try {
            $request->validate([
                'nip' => ['required', 'string', 'digits:10'],
            ], [
                'nip.required' => 'NIP wajib diisi.',
                'nip.digits' => 'NIP harus terdiri dari 10 digit angka.',
            ]);

            $user = User::where('nip', $request->nip)->first();

            if (!$user) {
                return back()
                    ->withErrors(['nip' => 'NIP tidak terdaftar dalam sistem.'])
                    ->withInput();
            }

            if (!$user->email) {
                return back()
                    ->withErrors(['nip' => 'Akun ini tidak memiliki email yang terdaftar.'])
                    ->withInput();
            }

            $token = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => Carbon::now()
                ]
            );

            try {
                Mail::send('emails.reset-kata-sandi', [
                    'token' => $token,
                    'name' => $user->name,
                    'nip' => $user->nip,
                ], function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Reset Kata Sandi')
                        ->from('noreply@bea.go.id', 'Direktorat Jenderal Bea dan Cukai');
                });
            } catch (Exception $e) {
                Log::error('Gagal mengirim email pengaturan ulang kata sandi:', [
                    'error' => $e->getMessage(),
                    'user' => $user->nip
                ]);
                return back()
                    ->withErrors(['error' => 'Gagal mengirim email untuk atur ulang kata sandi. Silakan coba lagi nanti!'])
                    ->withInput();
            }

            Log::info('Tautan pengaturan ulang kata sandi berhasil dikirim!', ['nip' => $user->nip]);
            return back()->with('success', 'Tautan atur ulang kata sandi telah dikirim ke email Anda.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            Log::error('Password reset error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan pada sistem. Silakan coba beberapa saat lagi!'])
                ->withInput();
        }
    }

    public function reset_kata_sandi(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'nip' => 'required|digits:10',
                'password' => 'required|min:8|confirmed',
            ], [
                'token.required' => 'Token tidak valid.',
                'nip.required' => 'NIP wajib diisi.',
                'nip.digits' => 'NIP harus terdiri dari 10 digit angka.',
                'password.required' => 'Kata sandi baru wajib diisi.',
                'password.min' => 'Kata sandi minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            ]);

            $user = User::where('nip', $request->nip)->first();
            if (!$user) {
                return back()->withErrors(['error' => 'NIP tidak ditemukan.']);
            }

            $reset_record = DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->first();

            if (!$reset_record || !Hash::check($request->token, $reset_record->token)) {
                return back()->withErrors(['error' => 'Token atur ulang kata sandi tidak valid!']);
            }

            if (Carbon::parse($reset_record->created_at)->addHours(1)->isPast()) {
                DB::table('password_reset_tokens')->where('email', $user->email)->delete();
                return back()->withErrors(['error' => 'Token atur ulang kata sandi telah kadaluarsa. Silakan meminta token baru!']);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            Log::info('Berhasil mengatur ulang kata sandi!', ['nip' => $user->nip]);

            return redirect()
                ->route('masuk')
                ->with('success', 'Kata sandi berhasil diatur ulang. Silakan masuk dengan kata sandi baru Anda.');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password', 'password_confirmation'));
        } catch (Exception $e) {
            Log::error('Kesalahan pengaturan ulang kata sandi:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan pada sistem. Silakan coba beberapa saat lagi!'])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }
}