<?php

namespace App\Http\Controllers;

use App\Http\Resources\DokumenMutuResource;
use App\Models\DokumenMutu;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DokumenMutuController extends Controller
{
    //
    public function index(Request $request)
    {

        $dataParameter = [];

        if ($request->filled('filter')) {
            try {
                $dataParameter = json_decode($request->filter, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                // Jika JSON tidak valid, abaikan atau return error
                $dataParameter = [];
            }
        }

        $query = DokumenMutu::query();

        $search = $request->input('search');

        $query = DokumenMutu::with('unit')->where(function ($query) use ($dataParameter) {
            if (isset($dataParameter['kategori']) && $dataParameter['kategori']) {
                $query->where('kategori', $dataParameter['kategori']);
            }
        });

        if ($search) {
            $query->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        }

        $dokumenMutus = $query->get();
        $units = Unit::all(['id', 'unit_name']); // sesuaikan kolom unit



        return Inertia::render('DokumenMutus/Index', [
            'parameter' => $dataParameter,
            'dokumenMutus' => DokumenMutuResource::collection($dokumenMutus)->resolve(),
            'units' => $units,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create(Request $request)
    {
        $kategori = $request->query('kategori');
        $units = Unit::all(['id', 'unit_name']);
        return Inertia::render('DokumenMutus/Create', compact('units', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode',
            'nama' => 'required|string|max:255',
            'sasaran' => 'required|in:Internal,Eksternal',
            'unit_id' => 'nullable|exists:units,id',
            'kategori' => 'required|string',
            'jenis_document' => 'required|in:Upload,Link Eksternal',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('dokumen_mutu', 'public');
        }

        DokumenMutu::create(array_merge(
            $request->only(['kode', 'nama', 'sasaran', 'unit_id', 'kategori', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('dokumen-mutus.index')->with('success', 'Dokumen Mutu berhasil ditambahkan.');
    }

    public function edit(DokumenMutu $dokumenMutu)
    {
        $units = Unit::all(['id', 'unit_name']);
        return Inertia::render('DokumenMutus/Edit', compact('dokumenMutu', 'units'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode,' . $id,
            'nama' => 'required|string|max:255',
            'sasaran' => 'required|in:Internal,Eksternal',
            'unit_id' => 'nullable|exists:units,id',
            'kategori' => 'required|string',
            'jenis_document' => 'required|in:Upload,Link Eksternal',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $dokumenMutu = DokumenMutu::findOrFail($id);


        if ($request->hasFile('document')) {
            $documentPath = $dokumenMutu->document_path;
            if ($documentPath) {
                Storage::delete($documentPath);
            }
            $documentPath = $request->file('document')->store('dokumen_mutu', 'public');
        } else {
            $documentPath = $request->document_path;
        }

        $dokumenMutu->update(array_merge(
            $request->only(['kode', 'nama', 'sasaran', 'unit_id', 'kategori', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('dokumen-mutus.index')->with('success', 'Dokumen Mutu berhasil diperbarui.');
    }

    public function destroy(DokumenMutu $dokumenMutu)
    {
        if ($dokumenMutu->document_path) {
            Storage::delete($dokumenMutu->document_path);
        }
        $dokumenMutu->delete();
        return to_route('dokumen-mutus.index')->with('success', 'Dokumen Mutu berhasil dihapus.');
    }
}
