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

    //visi & misi

    public function visimisi()
    {
        $identitas = Identitas::first();
        return Inertia::render('Identitas/EditVisiMisi', compact('identitas'));
    }

    public function updatevisimisi(Request $request)
    {
        $request->validate([
            'visimisi' => 'nullable|string',
        ]);

        $identitas = Identitas::firstOrNew();
        $identitas->fill($request->only(['visimisi']));
        $identitas->save();
        return Inertia::render('Identitas/EditVisiMisi', compact('identitas'))->with('success', 'Data identitas berhasil diperbarui.');
    }


    public function sejarah()
    {
        $identitas = Identitas::first();
        return Inertia::render('Identitas/EditSejarah', compact('identitas'));
    }


    public function organisasi()
    {
        $identitas = Identitas::first()->struktur_organisasi_path;
        return Inertia::render('Identitas/EditOrganisasi', compact('identitas'));
    }

    public function updatesejarah(Request $request)
    {
        $request->validate([
            'sejarah' => 'nullable|string',
        ]);

        $identitas = Identitas::firstOrNew();
        $identitas->fill($request->only(['sejarah']));
        $identitas->save();
        return redirect()->route('identitas.sejarah')->with('success', 'Data identitas berhasil diperbarui.');
    }


    //sejara

    public function updateorganisasi(Request $request)
    {
        $request->validate([
            'struktur_organisasi' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
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

        $identitas->fill($request->only(['struktur_organisasi_path']));
        $identitas->save();

        return redirect()->route('identitas.organisasi')->with('success', 'Data identitas berhasil diperbarui.');
    }
}
