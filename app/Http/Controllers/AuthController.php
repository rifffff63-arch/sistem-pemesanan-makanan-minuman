<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Wajib ditambahkan untuk enkripsi password
use App\Models\User; // Wajib ditambahkan untuk memanggil tabel users

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin')
            {
                return redirect('/dashboard');
            }

            return redirect('/');
        }

        return back()->with('error','Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // ==========================================
    // BAGIAN BARU: FITUR REGISTRASI AKUN
    // ==========================================

    public function showRegister()
    {
        // Mengarahkan ke file resources/views/auth/register.blade.php
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        // 1. Validasi input dari user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Harus cocok dengan 'password_confirmation'
        ], [
            'email.unique' => 'Email ini sudah terdaftar, silakan gunakan email lain!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);

        // 2. Simpan ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib dienkripsi
            'role' => 'user', // Otomatis jadikan role sebagai 'user'
        ]);

        // 3. Kembali ke halaman login dengan pesan sukses
        // (Kita menumpang session 'error' agar desain alert di login.blade.php langsung muncul)
        return redirect('/login')->with('error', 'Akun berhasil dibuat! Silakan login dengan akun baru Anda.');
    }
}