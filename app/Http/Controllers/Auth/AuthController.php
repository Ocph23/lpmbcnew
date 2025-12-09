<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🔹 Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 🔹 Proses registrasi
    public function register(Request $request)
    {
        // ✅ Tambahkan baris ini untuk test (sementara)
        // dd($request->all());

        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}
