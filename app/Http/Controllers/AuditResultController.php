<?php

namespace App\Http\Controllers;

use App\Models\AuditInstrument;
use App\Models\AuditResult;
use App\Models\AuditSchedule;
use App\Models\Document;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditResultController extends Controller
{
    //
    public function index(AuditSchedule $auditSchedule)
    {
        $results = $auditSchedule->auditResults()
            ->with('unit', 'audit_instrument', 'filledBy', 'verifiedBy', 'documentEvidence')
            ->latest()
            ->get();

        return view('audit_results.index', compact('auditSchedule', 'results'));
    }

    public function create(AuditSchedule $auditSchedule)
    {
        $units = Unit::orderBy('unit_name')->get();
        $instruments = AuditInstrument::active()->orderBy('instrument_code')->get();
        $documents = Document::orderBy('title')->get();
        return view('audit_results.create', compact('auditSchedule', 'units', 'instruments', 'documents'));
    }

    public function store(Request $request, AuditSchedule $auditSchedule)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'audit_instrument_id' => 'required|exists:audit_instruments,id',
            'score' => 'nullable|numeric|min:0|max:100',
            'evidence_note' => 'nullable|string',
            'document_evidence_id' => 'nullable|exists:documents,id',
        ]);

        AuditResult::create([
            'audit_schedule_id' => $auditSchedule->id,
            'unit_id' => $request->unit_id,
            'audit_instrument_id' => $request->audit_instrument_id,
            'score' => $request->score,
            'evidence_note' => $request->evidence_note,
            'document_evidence_id' => $request->document_evidence_id,
            'filled_by' => Auth::id(),
            'verification_status' => 'pending',
        ]);

        return redirect()
            ->route('audit-schedules.results.index', $auditSchedule)
            ->with('success', 'Audit result submitted successfully.');
    }

    public function show(AuditSchedule $auditSchedule, AuditResult $result)
    {
        if ($result->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $result->load('unit', 'audit_instrument', 'documentEvidence', 'filledBy', 'verifiedBy');
        return view('audit_results.show', compact('auditSchedule', 'result'));
    }

    public function edit(AuditSchedule $auditSchedule, AuditResult $result)
    {
        if ($result->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $units = Unit::orderBy('unit_name')->get();
        $audit_instrument = AuditInstrument::active()->orderBy('instrument_code')->get();
        $documents = Document::orderBy('title')->get();

        return view('audit_results.edit', compact('auditSchedule', 'result', 'units', 'audit_instrument', 'documents'));
    }

    public function update(Request $request, AuditSchedule $auditSchedule, AuditResult $result)
    {
        if ($result->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'audit_instrument_id' => 'required|exists:audit_instruments,id',
            'score' => 'nullable|numeric|min:0|max:100',
            'evidence_note' => 'nullable|string',
            'document_evidence_id' => 'nullable|exists:documents,id',
        ]);

        $result->update([
            'unit_id' => $request->unit_id,
            'audit_instrument_id' => $request->audit_instrument_id,
            'score' => $request->score,
            'evidence_note' => $request->evidence_note,
            'document_evidence_id' => $request->document_evidence_id,
            'filled_by' => Auth::id(),
        ]);

        return redirect()
            ->route('audit-schedules.results.index', $auditSchedule)
            ->with('success', 'Audit result updated successfully.');
    }

    public function destroy(AuditSchedule $auditSchedule, AuditResult $result)
    {
        if ($result->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $result->delete();
        return redirect()
            ->route('audit-schedules.results.index', $auditSchedule)
            ->with('success', 'Audit result deleted.');
    }

    // Optional: Verification action (by auditor)
    public function verify(Request $request, AuditSchedule $auditSchedule, AuditResult $result)
    {
        if ($result->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $request->validate([
            'verification_status' => 'required|in:verified,rejected',
            'verification_note' => 'nullable|string',
        ]);

        $result->update([
            'verified_by' => Auth::id(),
            'verification_status' => $request->verification_status,
            'verification_note' => $request->verification_note,
            'verified_at' => now(),
        ]);

        return back()->with('success', 'Result ' . $request->verification_status . ' successfully.');
    }
}
