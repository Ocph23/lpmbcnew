<?php

namespace App\Http\Controllers\AdminLPM;

use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class IdentitasController extends Controller
{
    //
    public function index()
    {
        $identitas = Identitas::first();
        return Inertia::render('Identitas/Edit', compact('identitas'));
    }

    public function edit()
    {
        $identitas = Identitas::first();
        return Inertia::render('Identitas/Edit', compact('identitas'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visimisi' => 'nullable|string',
            'sejarah' => 'nullable|string',
            'deskripsilpm' => 'nullable|string',
            'struktur_organisasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        $identitas = Identitas::firstOrNew();
        // Handle file upload
        if ($request->hasFile('struktur_organisasi')) {
            // Delete old file if exists
            if ($identitas->struktur_organisasi_path) {
                Storage::delete('public/' . $identitas->struktur_organisasi_path);
            }

            $path = $request->file('struktur_organisasi')->store('struktur', 'public');
            $identitas->struktur_organisasi_path = $path;
        }

        $identitas->fill($request->only(['visimisi', 'sejarah', 'deskripsilpm']));
        $identitas->save();

        return redirect()->route('identitas.index')->with('success', 'Data identitas berhasil diperbarui.');
    }
}
