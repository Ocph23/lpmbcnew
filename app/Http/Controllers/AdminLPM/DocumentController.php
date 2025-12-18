<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index(Request $request, $param)
    {

        $query = Document::query()->where('kategori', '=', $param);

        $search = $request->input('search');

        if ($search) {
            $query->where('kode', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%");
        }

        $Documents = $query->get();

        return Inertia::render('Documents/Index', [
            'param' => $param,
            'documents' =>  DocumentResource::collection($Documents)->resolve(),
            'filters' => $request->only(['search']),
        ]);
    }

    public function create(Request $request, $param)
    {
        return Inertia::render('Documents/Create', ['param' => $param]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode',
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:dasarhukum,skpendirian,pedoman,template,skrektor,spmidanami,panduankurikulum',
            'sasaran' => 'required|in:Internal,Public',
            'jenis_document' => 'required|in:Upload,Link Eksternal',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('dokumen_mutu', 'public');
        }

        Document::create(array_merge(
            $request->only(['kode', 'nama', 'kategori', 'sasaran', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('documents.index', $request->kategori)->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Document $document)
    {
        return Inertia::render('Documents/Edit', compact('document'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'kode' => 'required|string|unique:dokumen_mutus,kode,' . $id,
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:dasarhukum,skpendirian,pedoman,template,skrektor,spmidanami,panduankurikulum',
            'sasaran' => 'required|in:Internal,Public',
            'jenis_document' => 'required|in:Upload,Link Eksternal',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $Document = Document::findOrFail($id);


        if ($request->hasFile('document')) {
            $documentPath = $Document->document_path;
            if ($documentPath) {
                Storage::delete($documentPath);
            }
            $documentPath = $request->file('document')->store('instruments', 'public');
        } else {
            $documentPath = $request->document_path;
        }

        $Document->update(array_merge(
            $request->only(['kode', 'nama', 'kategori', 'sasaran', 'jenis_document']),
            ['document_path' => $documentPath]
        ));

        return to_route('documents.index', $request->kategori)->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $Document)
    {
        if ($Document->document_path) {
            Storage::delete($Document->document_path);
        }
        $Document->delete();
        return to_route('documents.index', $Document->kategori)->with('success', 'Dokumen berhasil dihapus.');
    }
}
