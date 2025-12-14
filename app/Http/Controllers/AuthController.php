<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika sudah login, jangan tampilkan form login lagi
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login menggunakan email dan password
        if (Auth::attempt($credentials)) {
            // Regenerate session ID untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();
            // Redirect ke halaman dashboard sesuai role
            return redirect()->intended('dashboard');
        }

        // Jika gagal, kembalikan dengan error
        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // Hapus session dan regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Redirect ke halaman login
        return redirect('/');
    }
}
