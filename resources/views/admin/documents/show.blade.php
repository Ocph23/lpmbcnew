@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Document Details</h1>
            <div>
                <a href="{{ route('documents.index') }}" class="btn btn-secondary btn-sm">← Back</a>
                <a href="{{ route('documents.edit', $document) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $document->title }}
            </div>
            <div class="card-body">
                <p><strong>Code:</strong> {{ $document->document_code }}</p>
                <p><strong>Title:</strong> {{ $document->title }}</p>
                <p><strong>Type:</strong> {{ $document->document_type_label }}</p>
                <p><strong>Status:</strong> {!! $document->status_badge !!}</p>
                <p><strong>Unit:</strong> {{ $document->unit?->unit_name ?? '—' }}</p>
                <p><strong>Uploaded By:</strong> {{ $document->uploadedBy?->name ?? 'System' }}</p>
                <p><strong>Related Standard:</strong> {{ $document->standar?->standar_name ?? '—' }}</p>
                <p><strong>Version:</strong> v{{ $document->version }}</p>
                @if ($document->previousVersion)
                    <p><strong>Previous Version:</strong>
                        <a href="{{ route('documents.show', $document->previousVersion) }}">
                            v{{ $document->previousVersion->version }} ({{ $document->previousVersion->document_code }})
                        </a>
                    </p>
                @endif
                <p><strong>Validity Date:</strong>
                    {{ $document->validity_date ? $document->validity_date->format('d F Y') : 'No expiry' }}</p>
                <p><strong>File:</strong>
                    <a href="{{ route('documents.download', $document) }}" class="link-primary">
                        <i class="fas fa-download"></i> {{ basename($document->file_path) }}
                    </a>
                    ({{ number_format($document->file_size / 1024, 2) }} KB)
                </p>
                <div>
                    <strong>Description:</strong>
                    <div class="mt-2 p-2 bg-light rounded">
                        {!! nl2br(e($document->description ?? '—')) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('documents.download', $document) }}" class="btn btn-primary">Download File</a>
                <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Permanently delete this document?')">
                        Delete Document
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
