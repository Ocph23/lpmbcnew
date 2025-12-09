@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Audit Result Details</h1>
            <div>
                <a href="{{ route('results.index', $auditSchedule) }}" class="btn btn-secondary btn-sm">←
                    Back</a>
                <a href="{{ route('results.edit', [$auditSchedule, $result]) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>Schedule:</strong> {{ $auditSchedule->audit_name }}</p>
                <p><strong>Unit:</strong> {{ $result->unit->unit_name ?? '—' }}</p>
                <p><strong>Instrument:</strong> {{ $result->instrument->question_text ?? '—' }}</p>
                <p><strong>Score:</strong> {{ $result->score ?? 'Not provided' }}</p>
                <p><strong>Evidence Note:</strong> {{ $result->evidence_note ?? '—' }}</p>
                @if ($result->documentEvidence)
                    <p><strong>Document Evidence:</strong>
                        <a href="{{ route('documents.download', $result->documentEvidence) }}" class="link-primary">
                            {{ $result->documentEvidence->title }}
                        </a>
                    </p>
                @endif
                <p><strong>Filled By:</strong> {{ $result->filledBy?->full_name ?? '—' }}</p>
                <p><strong>Verification Status:</strong> {!! $result->verification_status_badge !!}</p>
                @if ($result->verifiedBy)
                    <p><strong>Verified By:</strong> {{ $result->verifiedBy->full_name }}</p>
                    <p><strong>Verified At:</strong> {{ $result->verified_at?->format('d M Y H:i') }}</p>
                    <p><strong>Verification Note:</strong> {{ $result->verification_note ?? '—' }}</p>
                @endif
            </div>
            <div class="card-footer">
                @if ($result->verification_status === 'pending')
                    <form action="{{ route('results.verify', [$auditSchedule, $result]) }}" method="POST"
                        class="d-inline">
                        @csrf
                        <input type="hidden" name="verification_status" value="verified">
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        Reject
                    </button>
                @endif

                <form action="{{ route('results.destroy', [$auditSchedule, $result]) }}" method="POST"
                    class="d-inline float-end">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this result?')">
                        Delete Result
                    </button>
                </form>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('results.verify', [$auditSchedule, $result]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="verification_status" value="rejected">
                        <div class="modal-header">
                            <h5 class="modal-title">Reject Result</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Reason for rejection</label>
                                <textarea name="verification_note" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
