@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ isset($result) ? 'Edit' : 'Add' }} Audit Result</h1>

        <a href="{{ route('results.index', $auditSchedule) }}" class="btn btn-sm btn-outline-secondary mb-3">←
            Back</a>

        <form
            action="{{ isset($result) ? route('results.update', [$auditSchedule, $result]) : route('results.store', $auditSchedule) }}"
            method="POST">
            @csrf
            @isset($result)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Unit *</label>
                        <select name="unit_id" class="form-control" required>
                            <option value="">-- Select Unit --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    {{ (old('unit_id') ?? isset($result) && $result?->unit_id) == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->unit_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Audit Instrument *</label>
                        <select name="audit_instrument_id" class="form-control" required>
                            <option value="">-- Select Instrument --</option>
                            @foreach ($instruments as $inst)
                                <option value="{{ $inst->id }}"
                                    {{ (old('audit_instrument_id') ?? isset($result) && $result?->audit_instrument_id) == $inst->id ? 'selected' : '' }}>
                                    {{ $inst->instrument_code }} - {{ Str::limit($inst->question_text, 50) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Score (0–100)</label>
                        <input type="number" step="0.1" name="score" class="form-control"
                            value="{{ old('score', isset($result) ? $result->score : 0) }}" min="0" max="100">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Evidence Note</label>
                        <textarea name="evidence_note" class="form-control" rows="3">{{ old('evidence_note', isset($result) ? $result->avidance_note : '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Document Evidence (Optional)</label>
                        <select name="document_evidence_id" class="form-control">
                            <option value="">-- No Document --</option>
                            @foreach ($documents as $doc)
                                <option value="{{ $doc->id }}"
                                    {{ (old('document_evidence_id') ?? isset($result) && $result?->document_evidence_id) == $doc->id ? 'selected' : '' }}>
                                    {{ $doc->title }} ({{ $doc->document_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn {{ isset($result) ? 'btn-warning' : 'btn-success' }}">
                {{ isset($result) ? 'Update' : 'Submit' }} Result
            </button>
        </form>
    </div>
@endsection
