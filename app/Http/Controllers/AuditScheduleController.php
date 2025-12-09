<?php

namespace App\Http\Controllers;

use App\Models\AuditSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditScheduleController extends Controller
{
    //
    public function index()
    {
        $schedules = AuditSchedule::with('createdBy')
            ->latest()
            ->get();
        return view('admin.audit_schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.audit_schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_code' => 'required|string|max:50|unique:audit_schedules',
            'audit_name' => 'required|string|max:200',
            'audit_period' => 'required|string|max:50|regex:/^[a-z0-9_]+$/',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:draft,ongoing,completed',
        ]);

        AuditSchedule::create([
            'schedule_code' => $request->schedule_code,
            'audit_name' => $request->audit_name,
            'audit_period' => $request->audit_period,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('audit-schedules.index')
            ->with('success', 'Audit schedule created successfully.');
    }

    public function show(AuditSchedule $auditSchedule)
    {
        $auditSchedule->load('createdBy');
        return view('admin.audit_schedules.show', compact('auditSchedule'));
    }

    public function edit(AuditSchedule $auditSchedule)
    {
        return view('admin.audit_schedules.edit', compact('auditSchedule'));
    }

    public function update(Request $request, AuditSchedule $auditSchedule)
    {
        $request->validate([
            'schedule_code' => 'required|string|max:50|unique:audit_schedules,schedule_code,' . $auditSchedule->id,
            'audit_name' => 'required|string|max:200',
            'audit_period' => 'required|string|max:50|regex:/^[a-z0-9_]+$/',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:draft,ongoing,completed',
        ]);

        $auditSchedule->update($request->all());

        return redirect()->route('audit-schedules.index')
            ->with('success', 'Audit schedule updated successfully.');
    }

    public function destroy(AuditSchedule $auditSchedule)
    {
        $auditSchedule->delete();
        return redirect()->route('audit-schedules.index')
            ->with('success', 'Audit schedule deleted successfully.');
    }
}
