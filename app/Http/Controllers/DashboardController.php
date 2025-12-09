<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil data user login
        return view('dashboard', compact('user'));
    }

    // Contoh halaman tambahan (opsional)
    public function profile()
    {
        return view('pages.profile');
    }
}
