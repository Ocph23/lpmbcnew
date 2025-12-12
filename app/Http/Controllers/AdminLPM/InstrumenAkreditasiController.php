<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstrumenAkreditasiResource;
use App\Models\InstrumenAkreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class InstrumenAkreditasiController extends Controller
{
    public function index(Request $request)
    {

        $query = InstrumenAkreditasi::query();

        $search = $request->input('search');

        if ($search) {
            $query->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        }

        $InstrumenAkreditasis = $query->get();

        return Inertia::render('InstrumenAkreditasis/Index', [
            'InstrumenAkreditasis' => InstrumenAkreditasiResource::collection($InstrumenAkreditasis)->resolve(),
            'filters' => $request->only(['search']),
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('InstrumenAkreditasis/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode',
            'nama' => 'required|string|max:255',
            'sasaran' => 'required|in:Internal,Public',
            'jenis_document' => 'required|in:Upload,Link Eksternal',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('dokumen_mutu', 'public');
        }

        InstrumenAkreditasi::create(array_merge(
            $request->only(['kode', 'nama', 'sasaran', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('instrumen-akreditasi.index')->with('success', 'Dokumen Mutu berhasil ditambahkan.');
    }

    public function edit(InstrumenAkreditasi $instrumenAkreditasi)
    {


        return Inertia::render('InstrumenAkreditasis/Edit', compact('instrumenAkreditasi'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode,' . $id,
            'nama' => 'required|string|max:255',
            'sasaran' => 'required|in:Internal,Public',
            'jenis_document' => 'required|in:Upload,Link Eksternal',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $InstrumenAkreditasi = InstrumenAkreditasi::findOrFail($id);


        if ($request->hasFile('document')) {
            $documentPath = $InstrumenAkreditasi->document_path;
            if ($documentPath) {
                Storage::delete($documentPath);
            }
            $documentPath = $request->file('document')->store('instruments', 'public');
        } else {
            $documentPath = $request->document_path;
        }

        $InstrumenAkreditasi->update(array_merge(
            $request->only(['kode', 'nama', 'sasaran', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('instrumen-akreditasis.index', $request->kategori)->with('success', 'Dokumen Mutu berhasil diperbarui.');
    }

    public function destroy(InstrumenAkreditasi $InstrumenAkreditasi)
    {
        if ($InstrumenAkreditasi->document_path) {
            Storage::delete($InstrumenAkreditasi->document_path);
        }
        $InstrumenAkreditasi->delete();
        return to_route('instrumen-akreditasis.index')->with('success', 'Dokumen Mutu berhasil dihapus.');
    }
}
