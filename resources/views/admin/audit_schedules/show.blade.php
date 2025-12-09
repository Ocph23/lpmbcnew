@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Audit Schedule Details</h1>
            <div>
                <a href="{{ route('audit-schedules.index') }}" class="btn btn-secondary btn-sm">← Back</a>
                <a href="{{ route('audit-schedules.edit', $auditSchedule) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $auditSchedule->audit_name }}
            </div>
            <div class="card-body">
                <p><strong>Schedule Code:</strong> {{ $auditSchedule->schedule_code }}</p>
                <p><strong>Audit Name:</strong> {{ $auditSchedule->audit_name }}</p>
                <p><strong>Period:</strong> {{ $auditSchedule->audit_period_label }}</p>
                <p><strong>Date Range:</strong>
                    {{ $auditSchedule->start_date->format('d F Y') }} to
                    {{ $auditSchedule->end_date->format('d F Y') }}
                </p>
                <p><strong>Status:</strong> {!! $auditSchedule->status_badge !!}</p>
                <p><strong>Created By:</strong> {{ $auditSchedule->createdBy?->name ?? '—' }}</p>
                <p><strong>Created At:</strong> {{ $auditSchedule->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="card-footer text-end">
                <form action="{{ route('audit-schedules.destroy', $auditSchedule) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Delete this audit schedule permanently?')">
                        Delete Schedule
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
