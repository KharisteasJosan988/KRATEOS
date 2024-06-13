<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DaftarController extends Controller
{
    public function formDaftar()
    {
        return view('auth.daftar');
    }

    public function daftar(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z]+[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:users,email'
            ],
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Alamat Email wajib diisi.',
            'email.email' => 'Alamat Email harus berupa email yang valid.',
            'email.regex' => 'Alamat Email harus dimulai dengan huruf dan hanya mengandung karakter yang valid.',
            'email.unique' => 'Alamat Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki setidaknya 8 karakter.',
            'password.confirmed' => 'Konfirmasi Password tidak cocok.',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'activation_token' => Str::random(60),
        ]);

        // Kirim email aktivasi
        Mail::to($user->email)->send(new SendEmail($user));

        // Set session flash untuk notifikasi
        Session::flash('success', 'Registrasi berhasil! Cek email Anda untuk aktivasi.');

        // Redirect pengguna setelah pendaftaran berhasil
        return redirect()->route('auth.index');
    }

}
