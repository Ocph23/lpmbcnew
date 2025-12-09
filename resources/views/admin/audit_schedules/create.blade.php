@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Audit Schedule</h1>

        <form action="{{ route('audit-schedules.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Schedule Code *</label>
                        <input type="text" name="schedule_code" class="form-control" value="{{ old('schedule_code') }}"
                            maxlength="50" required>
                        @error('schedule_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Audit Name *</label>
                        <input type="text" name="audit_name" class="form-control" value="{{ old('audit_name') }}"
                            maxlength="200" required>
                        @error('audit_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Audit Period *</label>
                        <input type="text" name="audit_period" class="form-control"
                            placeholder="e.g., semester_ganjil_2024" value="{{ old('audit_period') }}" maxlength="50"
                            required>
                        <div class="form-text">Use lowercase, numbers, and underscores only (e.g., tahunan_2025)</div>
                        @error('audit_period')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Start Date *</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}"
                            required>
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date *</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Create Schedule</button>
                <a href="{{ route('audit-schedules.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
