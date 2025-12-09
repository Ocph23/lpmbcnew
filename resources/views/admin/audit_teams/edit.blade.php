@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Team Member</h1>

        <a href="{{ route('teams.index', $auditSchedule) }}" class="btn btn-sm btn-outline-secondary mb-3">←
            Back</a>

        <form action="{{ route('teams.update', [$auditSchedule, $team]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Auditor *</label>
                        <select name="auditor_id" class="form-control" required>
                            <option value="">-- Select --</option>
                            @foreach ($auditors as $auditor)
                                <option value="{{ $auditor->id }}"
                                    {{ (old('auditor_id') ?? $team->auditor_id) == $auditor->id ? 'selected' : '' }}>
                                    {{ $auditor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role *</label>
                        <select name="role_in_team" class="form-control" required>
                            <option value="ketua"
                                {{ (old('role_in_team') ?? $team->role_in_team) == 'ketua' ? 'selected' : '' }}>Ketua Tim
                            </option>
                            <option value="anggota"
                                {{ (old('role_in_team') ?? $team->role_in_team) == 'anggota' ? 'selected' : '' }}>Anggota
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Assigned Units</label>
                        <select name="assigned_units[]" class="form-control" multiple>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    @if (is_array(old('assigned_units'))) {{ in_array($unit->id, old('assigned_units')) ? 'selected' : '' }}
                                @else
                                    {{ is_array($team->assigned_units) && in_array($unit->id, $team->assigned_units) ? 'selected' : '' }} @endif>
                                    {{ $unit->unit_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Update Member</button>
        </form>
    </div>
@endsection
