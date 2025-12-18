<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Models\Monev;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MonevController extends Controller
{
    //
    public function akademik(Request $request)
    {
        $search = $request->input('search');
        $selectedPeriode = $request->input('periode_id');

        $query = Monev::with('periode')->where('status', '=', 'Akademik');

        if ($search) {
            $query->where('kode_monev', 'like', "%{$search}%")
                ->orWhere('nama_monev', 'like', "%{$search}%");
        }

        if ($selectedPeriode) {
            $query->where('periode_id', $selectedPeriode);
        }

        $monevs = $query->get();
        $periodes = Periode::all(['id', 'year', 'semester']);

        return Inertia::render('Monevs/Index', [
            'status' => 'Akademik',
            'monevs' => $monevs,
            'periodes' => $periodes,
            'filters' => $request->only(['search', 'periode_id']),
        ]);
    }
    public function nonakademik(Request $request)
    {
        $search = $request->input('search');
        $selectedPeriode = $request->input('periode_id');

        $query = Monev::with('periode')->where('status', '=', 'Non Akademik');

        if ($search) {
            $query->where('kode_monev', 'like', "%{$search}%")
                ->orWhere('nama_monev', 'like', "%{$search}%");
        }

        if ($selectedPeriode) {
            $query->where('periode_id', $selectedPeriode);
        }

        $monevs = $query->get();
        $periodes = Periode::all(['id', 'year', 'semester']);

        return Inertia::render('Monevs/Index', [
            'status' => 'Non Akademik',
            'monevs' => $monevs,
            'periodes' => $periodes,
            'filters' => $request->only(['search', 'periode_id']),
        ]);
    }

    public function create()
    {
        $periodes = Periode::all(['id', 'year', 'semester']);
        return Inertia::render('Monevs/Create', compact('periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_monev' => 'required|string|unique:monevs,kode_monev',
            'nama_monev' => 'required|string|max:255',
            'periode_id' => 'nullable|exists:periodes,id',
            'status' => 'required|in:Akademik,Non Akademik',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('monev_documents', 'public');
        }

        Monev::create(array_merge(
            $request->only(['kode_monev', 'nama_monev', 'periode_id', 'status']),
            ['document_path' => $documentPath]
        ));

        return to_route($request->status == 'Akademik' ? 'monevs.akademik' : 'monevs.nonakademik')->with('success', 'Data Monev berhasil ditambahkan.');
    }

    public function edit(Monev $monev)
    {
        $periodes = Periode::all(['id', 'year', 'semester']);
        return Inertia::render('Monevs/Edit', compact('monev', 'periodes'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'kode_monev' => 'required|string|unique:monevs,kode_monev,' . $id,
            'nama_monev' => 'required|string|max:255',
            'periode_id' => 'nullable|exists:periodes,id',
            'status' => 'required|in:Akademik,Non Akademik',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);


        $monev = Monev::findOrFail($id);

        $documentPath = $monev->document_path;

        if ($request->hasFile('document')) {
            if ($documentPath) {
                Storage::delete($documentPath);
            }
            $documentPath = $request->file('document')->store('monev_documents', 'public');
        }

        $monev->update(array_merge(
            $request->only(['kode_monev', 'nama_monev', 'periode_id', 'status']),
            ['document_path' => $documentPath]
        ));
        return to_route($request->status == 'Akademik' ? 'monevs.akademik' : 'monevs.nonakademik')->with('success', 'Data Monev berhasil ditambahkan.');
    }

    public function destroy(Monev $monev)
    {
        if ($monev->document_path) {
            Storage::delete($monev->document_path);
        }
        $monev->delete();
        return to_route('monevs.index')->with('success', 'Data Monev berhasil dihapus.');
    }
}
