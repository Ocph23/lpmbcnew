<?php

namespace App\Http\Controllers;

use App\Models\AuditInstrument;
use App\Models\Standar;
use Illuminate\Http\Request;

class AuditInstrumentController extends Controller
{
    //
    public function index()
    {
        $instruments = AuditInstrument::with('standar')->latest()->get();
        return view('admin.audit_instruments.index', compact('instruments'));
    }

    public function create()
    {
        $standars = Standar::orderBy('standar_name')->get();
        return view('admin.audit_instruments.create', compact('standars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instrument_code' => 'required|string|max:50|unique:audit_instruments',
            'question_text' => 'required|string',
            'standar_id' => 'nullable|exists:standars,id',
            'weight' => 'required|numeric|min:0',
            'evidence_type' => 'required|in:dokumen,observasi,wawancara',
        ]);

        AuditInstrument::create([
            'instrument_code' => $request->instrument_code,
            'question_text' => $request->question_text,
            'standar_id' => $request->standar_id,
            'weight' => $request->weight,
            'evidence_type' => $request->evidence_type,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('audit-instruments.index')
            ->with('success', 'Audit instrument created successfully.');
    }

    public function show(AuditInstrument $auditInstrument)
    {
        $auditInstrument->load('standar');
        return view('admin.audit_instruments.show', compact('auditInstrument'));
    }

    public function edit(AuditInstrument $auditInstrument)
    {
        $standars = Standar::orderBy('standar_name')->get();
        return view('admin.audit_instruments.edit', compact('auditInstrument', 'standars'));
    }

    public function update(Request $request, AuditInstrument $auditInstrument)
    {
        $request->validate([
            'instrument_code' => 'required|string|max:50|unique:audit_instruments,instrument_code,' . $auditInstrument->id,
            'question_text' => 'required|string',
            'standar_id' => 'nullable|exists:standars,id',
            'weight' => 'required|numeric|min:0',
            'evidence_type' => 'required|in:dokumen,observasi,wawancara',
        ]);

        $auditInstrument->update([
            'instrument_code' => $request->instrument_code,
            'question_text' => $request->question_text,
            'standar_id' => $request->standar_id,
            'weight' => $request->weight,
            'evidence_type' => $request->evidence_type,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('audit-instruments.index')
            ->with('success', 'Audit instrument updated successfully.');
    }

    public function destroy(AuditInstrument $auditInstrument)
    {
        $auditInstrument->delete();
        return redirect()->route('audit-instruments.index')
            ->with('success', 'Audit instrument deleted successfully.');
    }
}
