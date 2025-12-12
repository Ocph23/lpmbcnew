<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Models\Auditi;
use App\Models\Auditor;
use App\Models\JadwalAudit;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class JadwalAuditController extends Controller
{
    //
    public function index(Request $request)
    {
        $selectedPeriode = $request->input('periode_id');

        $query = JadwalAudit::with(['auditi', 'periode', 'auditor', 'auditor2']);

        if ($selectedPeriode) {
            $query->where('periode_id', $selectedPeriode);
        }

        $jadwalAudits = $query->get();
        $periodes = Periode::all(['id', 'year', 'semester']);

        return Inertia::render('JadwalAudits/Index', [
            'jadwalAudits' => $jadwalAudits,
            'periodes' => $periodes,
            'filters' => $request->only(['periode_id']),
        ]);
    }

    public function hasil(Request $request)
    {
        $selectedPeriode = $request->input('periode_id');

        $query = JadwalAudit::with(['auditi', 'periode', 'auditor', 'auditor2'])
            ->where('status', '=', 'terlaksana');

        if ($selectedPeriode) {
            $query->where('periode_id', $selectedPeriode);
        }

        $jadwalAudits = $query->get();
        $periodes = Periode::all(['id', 'year', 'semester']);

        return Inertia::render('JadwalAudits/Hasil', [
            'jadwalAudits' => $jadwalAudits,
            'periodes' => $periodes,
            'filters' => $request->only(['periode_id']),
        ]);
    }

    public function create()
    {
        $auditis = Auditi::all(['id', 'name']);
        $periodes = Periode::all(['id', 'year', 'semester']);
        // $auditors = User::get(['id', 'name']);

        $auditors = Auditor::all(['id', 'name', 'kategori']);


        // Jika tidak pakai Spatie, ganti dengan:
        // $auditors = User::all(['id', 'name']); // atau sesuaikan
        return Inertia::render('JadwalAudits/Create', compact('auditis', 'periodes', 'auditors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'auditi_id' => 'required|exists:auditis,id',
            'periode_id' => 'required|exists:periodes,id',
            'auditor_id' => 'nullable|exists:users,id',
            'start_date' => 'required|date',
            'status' => 'required|in:terjadwal,terlaksana',
            'auditor2_id' => 'nullable|exists:users,id',
        ]);

        JadwalAudit::create($request->only([
            'auditi_id',
            'periode_id',
            'auditor_id',
            'auditor2_id',
            'start_date',
            'status',
        ]));

        return to_route('jadwal-audits.index')->with('success', 'Jadwal audit berhasil ditambahkan.');
    }

    public function edit(JadwalAudit $jadwalAudit)
    {
        $auditis = Auditi::all(['id', 'name']);
        $periodes = Periode::all(['id', 'year', 'semester']);
        $auditors = User::all(['id', 'name']); // sesuaikan dengan kebutuhan

        return Inertia::render('JadwalAudits/Edit', compact('jadwalAudit', 'auditis', 'periodes', 'auditors'));
    }

    public function update(Request $request, JadwalAudit $jadwalAudit)
    {

        $rules = [
            'auditi_id' => 'required|exists:auditis,id',
            'periode_id' => 'required|exists:periodes,id',
            'auditor_id' => 'nullable|exists:users,id',
            'auditor2_id' => 'nullable|exists:users,id',
            'start_date' => 'required|date',
            'status' => 'required|in:terjadwal,terlaksana',
        ];

        // Jika status = "terlaksana", dokumen wajib
        if ($request->status === 'terlaksana') {
            $rules['document'] = 'required|file|max:10240'; // max 10MB
        }

        $request->validate($rules);

        // Handle upload dokumen
        $documentPath = $jadwalAudit->document_path;

        if ($request->hasFile('document')) {
            // Hapus dokumen lama jika ada
            if ($documentPath) {
                Storage::delete($documentPath);
            }
            $documentPath = $request->file('document')->store('audit_documents', 'public');
        }

        // Jika status diubah ke "terjadwal", hapus dokumen
        if ($request->status === 'terjadwal' && $jadwalAudit->status === 'terlaksana') {
            if ($documentPath) {
                Storage::delete($documentPath);
                $documentPath = null;
            }
        }

        $data = array_merge(
            $request->only(['auditi_id', 'periode_id', 'auditor_id', 'auditor2_id', 'start_date', 'status']),
            ['document_path' => $documentPath]
        );
        $jadwalAudit = JadwalAudit::findOrFail($request->id);
        $jadwalAudit->update($data);
        return to_route('jadwal-audits.index')->with('success', 'Jadwal audit berhasil diperbarui.');
    }

    public function destroy(JadwalAudit $jadwalAudit)
    {
        $jadwalAudit->delete();
        return to_route('jadwal-audits.index')->with('success', 'Jadwal audit berhasil dihapus.');
    }
}
