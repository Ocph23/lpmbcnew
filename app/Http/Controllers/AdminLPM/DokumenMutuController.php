<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Http\Resources\DokumenMutuResource;
use App\Models\DokumenMutu;
use App\Models\auditi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DokumenMutuController extends Controller
{
    //
    public function filter(Request $request, $param)
    {

        $query = DokumenMutu::query();

        $search = $request->input('search');

        $query = DokumenMutu::with('auditi')->where(function ($query) use ($param) {
            if ($param) {
                $query->where('kategori', $param);
            }
        });

        if ($search) {
            $query->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        }

        $dokumenMutus = $query->get();
        $auditis = Auditi::all(['id', 'name']); // sesuaikan kolom auditi



        return Inertia::render('DokumenMutus/Index', [
            'parameter' => $param,
            'dokumenMutus' => DokumenMutuResource::collection($dokumenMutus)->resolve(),
            'auditis' => $auditis,
            'filters' => $request->only(['search']),
        ]);
    }
    // public function index(Request $request)
    // {
    //     $dataParameter = [];

    //     if ($request->filled('filter')) {
    //         try {
    //             $dataParameter = json_decode($request->filter, true, 512, JSON_THROW_ON_ERROR);
    //         } catch (\JsonException $e) {
    //             // Jika JSON tidak valid, abaikan atau return error
    //             $dataParameter = [];
    //         }
    //     }

    //     $query = DokumenMutu::query();

    //     $search = $request->input('search');

    //     $query = DokumenMutu::with('auditi')->where(function ($query) use ($dataParameter) {
    //         if (isset($dataParameter['kategori']) && $dataParameter['kategori']) {
    //             $query->where('kategori', $dataParameter['kategori']);
    //         }
    //     });

    //     if ($search) {
    //         $query->where('kode', 'like', "%{$search}%")
    //             ->orWhere('nama', 'like', "%{$search}%");
    //     }

    //     $dokumenMutus = $query->get();
    //     $auditis = Auditi::all(['id', 'name']); // sesuaikan kolom auditi



    //     return Inertia::render('DokumenMutus/Index', [
    //         'parameter' => $dataParameter,
    //         'dokumenMutus' => DokumenMutuResource::collection($dokumenMutus)->resolve(),
    //         'auditis' => $auditis,
    //         'filters' => $request->only(['search']),
    //     ]);
    // }

    public function create(Request $request, $param)
    {
        $kategori = $param;
        $auditis = Auditi::all(['id', 'name']);
        $hasauditi = in_array($kategori, ['Formulir SPMI', 'Prosedur Kerja', 'Standar UPPS|auditi']);
        return Inertia::render('DokumenMutus/Create', compact('auditis', 'kategori', 'hasauditi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode',
            'nama' => 'required|string|max:255',
            'sasaran' => 'required|in:Internal,Eksternal',
            'auditi_id' => 'nullable|exists:auditis,id',
            'kategori' => 'required|string',
            'jenis_document' => 'required|in:Upload,Link Eksternal',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('dokumen_mutu', 'public');
        }

        DokumenMutu::create(array_merge(
            $request->only(['kode', 'nama', 'sasaran', 'auditi_id', 'kategori', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('dokumen-mutus.filter', $request->kategori)->with('success', 'Dokumen Mutu berhasil ditambahkan.');
    }

    public function edit(DokumenMutu $dokumenMutu)
    {

        $auditis = Auditi::all(['id', 'name']);
        return Inertia::render('DokumenMutus/Edit', compact('dokumenMutu', 'auditis'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode,' . $id,
            'nama' => 'required|string|max:255',
            'sasaran' => 'required|in:Internal,Eksternal',
            'auditi_id' => 'nullable|exists:auditis,id',
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
            $request->only(['kode', 'nama', 'sasaran', 'auditi_id', 'kategori', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('dokumen-mutus.filter', $request->kategori)->with('success', 'Dokumen Mutu berhasil diperbarui.');
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
