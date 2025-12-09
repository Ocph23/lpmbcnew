@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Team for: {{ $auditSchedule->audit_name }}</h1>
            <a href="{{ route('teams.create', $auditSchedule) }}" class="btn btn-primary">Add Team
                Member</a>
        </div>

        <a href="{{ route('audit-schedules.index') }}" class="btn btn-sm btn-outline-secondary mb-3">← Back to
            Schedules</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($teams->isEmpty())
            <div class="alert alert-info">No team members assigned yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Auditor</th>
                            <th>Role</th>
                            <th>Assigned Units</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $team)
                            <tr>
                                <td>{{ $team->auditor->name ?? '—' }}</td>
                                <td>{{ $team->role_label }}</td>
                                <td>
                                    @if ($team->assigned_units)
                                        @php
                                            $unitNames = [];
                                            if (is_array($team->assigned_units)) {
                                                foreach ($team->assigned_units as $unitId) {
                                                    $unit = \App\Models\Unit::find($unitId);
                                                    $unitNames[] = $unit?->unit_name ?? "ID:{$unitId}";
                                                }
                                            }
                                        @endphp
                                        {{ implode(', ', $unitNames) ?: '—' }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('teams.show', [$auditSchedule, $team]) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('teams.edit', [$auditSchedule, $team]) }}"
                                        class="btn btn-sm btn-warning">Edits</a>
                                    <form action="{{ route('teams.destroy', [$auditSchedule, $team]) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Remove this member?')">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
