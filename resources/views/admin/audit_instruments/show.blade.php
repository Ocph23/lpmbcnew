@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Instrument Details</h1>
            <div>
                <a href="{{ route('audit-instruments.index') }}" class="btn btn-secondary btn-sm">← Back</a>
                <a href="{{ route('audit-instruments.edit', $auditInstrument) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $auditInstrument->instrument_code }}
            </div>
            <div class="card-body">
                <p><strong>Question:</strong></p>
                <div class="p-2 bg-light rounded">{{ $auditInstrument->question_text }}</div>

                <p><strong>Standard:</strong> {{ $auditInstrument->standard?->standard_name ?? '—' }}</p>
                <p><strong>Evidence Type:</strong> {{ $auditInstrument->evidence_type_label }}</p>
                <p><strong>Weight:</strong> {{ number_format($auditInstrument->weight, 2) }}</p>
                <p><strong>Status:</strong> {!! $auditInstrument->status_badge !!}</p>
            </div>
            <div class="card-footer text-end">
                <form action="{{ route('audit-instruments.destroy', $auditInstrument) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this instrument?')">
                        Delete Instrument
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
