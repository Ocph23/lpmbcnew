@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add Team Member to: {{ $auditSchedule->audit_name }}</h1>

        <a href="{{ route('teams.index', $auditSchedule) }}" class="btn btn-sm btn-outline-secondary mb-3">←
            Back</a>

        <form action="{{ route('teams.store', $auditSchedule) }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Auditor *</label>
                        <select name="auditor_id" class="form-control" required>
                            <option value="">-- Select Auditor --</option>
                            @foreach ($auditors as $auditor)
                                <option value="{{ $auditor->id }}"
                                    {{ old('auditor_id') == $auditor->id ? 'selected' : '' }}>
                                    {{ $auditor->name }} ({{ $auditor->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('auditor_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role *</label>
                        <select name="role_in_team" class="form-control" required>
                            <option value="ketua" {{ old('role_in_team') == 'ketua' ? 'selected' : '' }}>Ketua Tim</option>
                            <option value="anggota" {{ old('role_in_team') == 'anggota' ? 'selected' : '' }}>Anggota
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
                                    {{ old('assigned_units') && in_array($unit->id, old('assigned_units')) ? 'selected' : '' }}>
                                    {{ $unit->unit_name }} ({{ $unit->unit_code }})
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Hold Ctrl/Cmd to select multiple units</div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Add to Team</button>
        </form>
    </div>
@endsection
