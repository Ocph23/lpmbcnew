<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update profile (detail akun)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi data akun
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
        ]);

        $user->update($request->only([
            'username', 'first_name', 'last_name', 'organization', 'location', 'phone', 'birthday'
        ]));

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Upload/update foto profile
     */
    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:5120', // max 5MB
        ]);

        // Hapus foto lama jika ada
        if ($user->photo && Storage::disk('public')->exists('profile/' . $user->photo)) {
            Storage::disk('public')->delete('profile/' . $user->photo);
        }

        // Simpan foto baru
        $path = $request->file('photo')->store('profile', 'public');
        $user->photo = basename($path);
        $user->save();

        return redirect()->back()->with('success', 'Profile photo updated successfully.');
    }

    /**
     * Tampilkan halaman settings (ganti password)
     */
    public function settings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui');
    }
}
