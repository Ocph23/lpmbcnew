<?php

namespace App\Http\Controllers;

use App\Models\AuditSchedule;
use App\Models\AuditTeam;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class AuditTeamController extends Controller
{
    //

    public function index(AuditSchedule $auditSchedule)
    {
        $teams = $auditSchedule->auditTeamMembers()->with('auditor')->get();
        return view('admin.audit_teams.index', compact('auditSchedule', 'teams'));
    }

    public function create(AuditSchedule $auditSchedule)
    {
        $auditors = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'auditor');
        })->get();


        $units = Unit::orderBy('unit_name')->get();

        return view('admin.audit_teams.create', compact('auditSchedule', 'auditors', 'units'));
    }

    public function store(Request $request, AuditSchedule $auditSchedule)
    {
        $request->validate([
            'auditor_id' => 'required|exists:users,id',
            'role_in_team' => 'required|in:ketua,anggota',
            'assigned_units' => 'nullable|array',
            'assigned_units.*' => 'exists:units,id',
        ]);

        // Prevent duplicate auditor in same schedule
        if (AuditTeam::where('audit_schedule_id', $auditSchedule->id)
            ->where('auditor_id', $request->auditor_id)
            ->exists()
        ) {
            return back()->withErrors(['auditor_id' => 'This auditor is already assigned to this schedule.']);
        }

        AuditTeam::create([
            'audit_schedule_id' => $auditSchedule->id,
            'auditor_id' => $request->auditor_id,
            'role_in_team' => $request->role_in_team,
            'assigned_units' => $request->assigned_units ?? [],
        ]);

        return redirect()->route('audit-schedules.teams.index', $auditSchedule)
            ->with('success', 'Auditor added to team successfully.');
    }

    public function show(AuditSchedule $auditSchedule, AuditTeam $team)
    {
        // Ensure team belongs to this schedule
        if ($team->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $team->load('auditor');
        return view('admin.audit_teams.show', compact('auditSchedule', 'team'));
    }

    public function edit(AuditSchedule $auditSchedule, AuditTeam $team)
    {
        if ($team->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $auditors = User::orderBy('name')->get();
        $units = Unit::orderBy('unit_name')->get();

        return view('admin.audit_teams.edit', compact('auditSchedule', 'team', 'auditors', 'units'));
    }

    public function update(Request $request, AuditSchedule $auditSchedule, AuditTeam $team)
    {
        if ($team->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $request->validate([
            'auditor_id' => 'required|exists:users,id',
            'role_in_team' => 'required|in:ketua,anggota',
            'assigned_units' => 'nullable|array',
            'assigned_units.*' => 'exists:units,id',
        ]);

        // Prevent changing to an auditor already in team (unless same)
        if (
            $team->auditor_id !== $request->auditor_id &&
            AuditTeam::where('audit_schedule_id', $auditSchedule->id)
            ->where('auditor_id', $request->auditor_id)
            ->exists()
        ) {
            return back()->withErrors(['auditor_id' => 'This auditor is already assigned to this schedule.']);
        }

        $team->update([
            'auditor_id' => $request->auditor_id,
            'role_in_team' => $request->role_in_team,
            'assigned_units' => $request->assigned_units ?? [],
        ]);

        return redirect()->route('audit-schedules.teams.index', $auditSchedule)
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(AuditSchedule $auditSchedule, AuditTeam $team)
    {
        if ($team->audit_schedule_id !== $auditSchedule->id) {
            abort(404);
        }

        $team->delete();

        return redirect()->route('audit-schedules.teams.index', $auditSchedule)
            ->with('success', 'Team member removed successfully.');
    }
}
