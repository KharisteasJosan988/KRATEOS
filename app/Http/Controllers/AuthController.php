<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ValidatesRequests;

    public function formLogin()
    {
        return view('auth.login');
    }

    public function verifyLogin(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z]+[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email diperlukan.',
            'email.regex' => 'Email harus dimulai dengan sebuah huruf dan terdiri dari format email yang benar.',
            'password.required' => 'Password diperlukan.',
            'password.min' => 'Password harus terdiri dari setidaknya 8 karakter.',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba autentikasi dengan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            // Jika berhasil, redirect ke dashboard admin
            return redirect()->intended('/admin/dashboard');
        }

        // Coba autentikasi dengan guard 'web' (pengguna biasa)
        elseif (Auth::guard('web')->attempt($credentials)) {
            // Jika berhasil, redirect ke dashboard pengguna
            return redirect()->intended('/user/dashboard');
        }

        // Jika keduanya gagal, kembalikan ke halaman login dengan pesan error
        else {
            return redirect('/')->withErrors(['login' => 'Email dan/atau password tidak ditemukan'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.index'));
    }
}
