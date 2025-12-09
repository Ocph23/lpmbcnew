<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Standar;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('unit', 'standard', 'uploadedBy')
            ->latest()
            ->get();
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $units = Unit::orderBy('unit_name')->get();
        $standars = Standar::orderBy('standar_name')->get();
        return view('admin.documents.create', compact('units', 'standars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_code' => 'required|string|max:50|unique:documents',
            'title' => 'required|string|max:300',
            'description' => 'nullable|string',
            'file' => 'required|file', // max 10MB
            'document_type' => 'required|in:kebijakan,sop,formulir,bukti',
            'unit_id' => 'required|exists:units,id',
            'standar_id' => 'nullable|exists:standars,id',
            'validity_date' => 'nullable|date|after:today',
            'version' => 'nullable|integer|min:1',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('documents', 'public'); // stored in storage/app/public/documents

        Document::create([
            'document_code' => $request->document_code,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'document_type' => $request->document_type,
            'unit_id' => $request->unit_id,
            'uploaded_by' => Auth::id(),
            'validity_date' => $request->validity_date,
            'status' => 'draft',
            'standar_id' => $request->standar_id,
            'version' => $request->version ?? 1,
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    public function show(Document $document)
    {
        $document->load('unit', 'standard', 'uploadedBy', 'previousVersion');
        return view('admin.documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $units = Unit::orderBy('unit_name')->get();
        $standars = Standar::orderBy('standar_name')->get();
        return view('admin.documents.edit', compact('document', 'units', 'standars'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'document_code' => 'required|string|max:50|unique:documents,document_code,' . $document->id,
            'title' => 'required|string|max:300',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg|max:10240',
            'document_type' => 'required|in:kebijakan,sop,formulir,bukti',
            'unit_id' => 'required|exists:units,id',
            'standar_id' => 'nullable|exists:standars,id',
            'validity_date' => 'nullable|date|after:today',
            'status' => 'required|in:draft,approved,expired',
            'version' => 'nullable|integer|min:1',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Delete old file
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('file');
            $data['file_path'] = $file->store('documents', 'public');
            $data['file_size'] = $file->getSize();
            $data['mime_type'] = $file->getMimeType();
        }

        $document->update($data);

        return redirect()->route('documents.index')
            ->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        // Delete file from storage


        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document deleted successfully.');
    }

    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404);
        }


        $extention = $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($document->file_path, $document->title . '.' . $extension);
    }
}
