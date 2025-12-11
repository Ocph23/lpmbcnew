<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Models\Auditi;
use App\Models\DokumenAkreditasi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DokumenAkreditasiController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $selectedAuditi = $request->input('auditi_id');

        $query = DokumenAkreditasi::with('auditi');

        if ($search) {
            $query->where('lembaga_akreditasi', 'like', "%{$search}%")
                ->orWhere('jenjang', 'like', "%{$search}%")
                ->orWhere('peringkat', 'like', "%{$search}%");
        }

        if ($selectedAuditi) {
            $query->where('auditi_id', $selectedAuditi);
        }

        $dokumenAkreditasis = $query->get();
        $auditis = Auditi::all(['id', 'name']);

        return Inertia::render('DokumenAkreditasi/Index', [
            'dokumenAkreditasis' => $dokumenAkreditasis,
            'auditis' => $auditis,
            'filters' => $request->only(['search', 'auditi_id']),
        ]);
    }

    public function create()
    {
        $auditis = Auditi::all(['id', 'name']);
        return Inertia::render('DokumenAkreditasi/Create', compact('auditis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'auditi_id' => 'nullable|exists:auditis,id',
            'lembaga_akreditasi' => 'required|string',
            'jenjang' => 'required|string',
            'peringkat' => 'required|string',
            'tanggal_sk' => 'nullable|date',
            'tanggal_mulai' => 'nullable|date|before_or_equal:tanggal_berakhir',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'link_sk' => 'nullable|url',
            'link_sertifikat' => 'nullable|url',
        ]);

        DokumenAkreditasi::create($request->all());

        return to_route('dokumen-akreditasi.index')->with('success', 'Dokumen akreditasi berhasil ditambahkan.');
    }

    public function edit(DokumenAkreditasi $dokumenAkreditasi)
    {
        $auditis = Auditi::all(['id', 'name']);
        return Inertia::render('DokumenAkreditasi/Edit', compact('dokumenAkreditasi', 'auditis'));
    }

    public function update(Request $request, DokumenAkreditasi $dokumenAkreditasi)
    {
        $request->validate([
            'auditi_id' => 'nullable|exists:auditis,id',
            'lembaga_akreditasi' => 'required|string',
            'jenjang' => 'required|string',
            'peringkat' => 'required|string',
            'tanggal_sk' => 'nullable|date',
            'tanggal_mulai' => 'nullable|date|before_or_equal:tanggal_berakhir',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'link_sk' => 'nullable|url',
            'link_sertifikat' => 'nullable|url',
        ]);

        $dokumenAkreditasi->update($request->all());

        return to_route('dokumen-akreditasi.index')->with('success', 'Dokumen akreditasi berhasil diperbarui.');
    }

    public function destroy(DokumenAkreditasi $dokumenAkreditasi)
    {
        $dokumenAkreditasi->delete();
        return to_route('dokumen-akreditasi.index')->with('success', 'Dokumen akreditasi berhasil dihapus.');
    }
}
