@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Team Member Details</h1>

        <a href="{{ route('audit-schedules.teams.index', $auditSchedule) }}" class="btn btn-sm btn-outline-secondary mb-3">←
            Back</a>

        <div class="card">
            <div class="card-body">
                <p><strong>Auditor:</strong> {{ $team->auditor->name ?? '—' }}</p>
                <p><strong>Role:</strong> {{ $team->role_label }}</p>
                <p><strong>Assigned Units:</strong></p>
                <ul>
                    @if ($team->assigned_units && is_array($team->assigned_units))
                        @foreach ($team->assigned_units as $unitId)
                            @php($unit = \App\Models\Unit::find($unitId))
                            <li>{{ $unit?->unit_name ?? "Unit ID: {$unitId}" }}</li>
                        @endforeach
                    @else
                        <li>No units assigned</li>
                    @endif
                </ul>
            </div>
            <div class="card-footer">
                <a href="{{ route('audit-schedules.teams.edit', [$auditSchedule, $team]) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('audit-schedules.teams.destroy', [$auditSchedule, $team]) }}" method="POST"
                    class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Remove this team member?')">
                        Remove from Team
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
