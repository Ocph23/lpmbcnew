<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    //
    public function index()
    {
        $laporans = Laporan::latest()->get();
        return view('laporans.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'description' => 'nullable|string',
            'file' => 'required|file|max:10240', // 10MB max
            'document_type' => 'required|in:spme,spmi,pusatdata',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('laporans', 'public');

        Laporan::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'document_type' => $request->document_type,
        ]);

        return redirect()->route('laporans.index')
            ->with('success', 'Laporan berhasil diunggah.');
    }

    public function show(Laporan $laporan)
    {
        return view('laporans.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        return view('laporans.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'title' => 'required|string|max:300',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,jpg,jpeg,png|max:10240',
            'document_type' => 'required|in:kebijakan,sop,formulir,bukti',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Delete old file
            if (Storage::disk('public')->exists($laporan->file_path)) {
                Storage::disk('public')->delete($laporan->file_path);
            }

            $file = $request->file('file');
            $data['file_path'] = $file->store('laporans', 'public');
            $data['file_size'] = $file->getSize();
            $data['mime_type'] = $file->getMimeType();
        }

        $laporan->update($data);

        return redirect()->route('laporans.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        // Delete file from storage
        if (Storage::disk('public')->exists($laporan->file_path)) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        $laporan->delete();

        return redirect()->route('laporans.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    // Download action
    public function download(Laporan $laporan)
    {
        if (!Storage::disk('public')->exists($laporan->file_path)) {
            abort(404);
        }
        $extention = $extension = pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($laporan->file_path, $laporan->title . '.' . $extension);
    }
}
