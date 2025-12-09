@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Audit Instrument</h1>

        <form action="{{ route('audit-instruments.update', $auditInstrument) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Instrument Code *</label>
                        <input type="text" name="instrument_code" class="form-control"
                            value="{{ old('instrument_code', $auditInstrument->instrument_code) }}" maxlength="50" required>
                        @error('instrument_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Question Text *</label>
                        <textarea name="question_text" class="form-control" rows="4" required>{{ old('question_text', $auditInstrument->question_text) }}</textarea>
                        @error('question_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Standar</label>
                        <select name="standar_id" class="form-control">
                            <option value="">-- Not Linked --</option>
                            @foreach ($standars as $standar)
                                <option value="{{ $standar->id }}"
                                    {{ (old('standar_id') ?? $auditInstrument->standar_id) == $standar->id ? 'selected' : '' }}>
                                    {{ $standar->standar_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Evidence Type *</label>
                        <select name="evidence_type" class="form-control" required>
                            <option value="dokumen"
                                {{ (old('evidence_type') ?? $auditInstrument->evidence_type) == 'dokumen' ? 'selected' : '' }}>
                                Dokumen</option>
                            <option value="observasi"
                                {{ (old('evidence_type') ?? $auditInstrument->evidence_type) == 'observasi' ? 'selected' : '' }}>
                                Observasi</option>
                            <option value="wawancara"
                                {{ (old('evidence_type') ?? $auditInstrument->evidence_type) == 'wawancara' ? 'selected' : '' }}>
                                Wawancara</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Weight *</label>
                        <input type="number" step="0.01" name="weight" class="form-control"
                            value="{{ old('weight', $auditInstrument->weight) }}" min="0" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                            {{ old('is_active', $auditInstrument->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Active</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Update Instrument</button>
            <a href="{{ route('audit-instruments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
