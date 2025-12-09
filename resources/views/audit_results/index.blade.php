@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Audit Results for: {{ $auditSchedule->audit_name }}</h1>
            <a href="{{ route('results.create', $auditSchedule) }}" class="btn btn-primary">Add Result</a>
        </div>

        <a href="{{ route('audit-schedules.index') }}" class="btn btn-sm btn-outline-secondary mb-3">← Back to
            Schedules</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($results->isEmpty())
            <div class="alert alert-info">No results submitted yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table">
                        <tr>
                            <th>Unit</th>
                            <th>Instrument</th>
                            <th>Score</th>
                            <th>Evidence</th>
                            <th>Filled By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                <td>{{ $result->unit->unit_name ?? '—' }}</td>
                                <td>{{ $result->audit_instrument->instrument_code }}<br><small>{{ Str::limit($result->audit_instrument->question_text, 40) }}</small>
                                </td>
                                <td>{{ $result->score ?? '—' }}</td>
                                <td>
                                    @if ($result->documentEvidence)
                                        <a href="{{ route('documents.download', $result->documentEvidence) }}"
                                            class="link-primary">
                                            {{ Str::limit($result->documentEvidence->title, 20) }}
                                        </a>
                                    @else
                                        {{ Str::limit($result->evidence_note, 30) ?? '—' }}
                                    @endif
                                </td>
                                <td>{{ $result->filledBy?->full_name ?? '—' }}</td>
                                <td>{!! $result->verification_status_badge !!}</td>
                                <td>
                                    <a href="{{ route('results.show', [$auditSchedule, $result]) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('results.edit', [$auditSchedule, $result]) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('results.destroy', [$auditSchedule, $result]) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete?')">
                                            Delete
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
