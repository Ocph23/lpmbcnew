<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akreditasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AkreditasiController extends Controller
{
    public function index()
    {
        $data = Akreditasi::first();

        // Jika belum ada data, buat default
        if (!$data) {
            $data = Akreditasi::create([
                'unggul' => 0,
                'peringkat_a' => 0,
                'baik_sekali' => 0,
                'peringkat_baik' => 0,
                'peringkat_b' => 0,
            ]);
        }
        return Inertia::render('Akreditasi/Index', [
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'unggul' => 'required|integer|min:0',
            'peringkat_a' => 'required|integer|min:0',
            'baik_sekali' => 'required|integer|min:0',
            'peringkat_baik' => 'required|integer|min:0',
            'peringkat_b' => 'required|integer|min:0',
        ]);

        $data = Akreditasi::first();

        $data->update([
            'unggul' => $request->unggul,
            'peringkat_a' => $request->peringkat_a,
            'baik_sekali' => $request->baik_sekali,
            'peringkat_baik' => $request->peringkat_baik,
            'peringkat_b' => $request->peringkat_b,
        ]);

        return redirect()->back()->with('success', 'Data akreditasi berhasil diperbarui!');
    }
    public function updateinstitusi(Request $request)
    {
        $data = $request->except('file');
        $file = $request->file('file');
        $filename = "sertifikat_institusi.png";
        $file->storeAs('sertifikat', $filename, 'public');

        return redirect()->back()->with('success', 'Data Sertifikat berhasil diperbarui!');
    }

    public function institusi()
    {
        $filename = "sertifikat_institusi.png";
        $data = ["filename" => $filename];
        return view('dashboard.akreditasi.institusi', compact('filename'));
    }
}
