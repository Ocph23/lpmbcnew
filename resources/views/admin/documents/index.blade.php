@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Documents</h1>
            <a href="{{ route('documents.create') }}" class="btn btn-primary">Upload New Document</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table">
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Valid Until</th>
                        <th>Version</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $document)
                        <tr>
                            <td>{{ $document->document_code }}</td>
                            <td>{{ Str::limit($document->title, 40) }}</td>
                            <td>{{ $document->document_type_label }}</td>
                            <td>{{ $document->unit->unit_name ?? '—' }}</td>
                            <td>{!! $document->status_badge !!}</td>
                            <td>{{ $document->validity_date ? $document->validity_date->format('d M Y') : '—' }}</td>
                            <td>v{{ $document->version }}</td>
                            <td>
                                <a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('documents.download', $document) }}"
                                    class="btn btn-sm btn-outline-primary">Download</a>
                                <a href="{{ route('documents.edit', $document) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this document?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No documents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
