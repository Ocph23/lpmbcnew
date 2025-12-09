@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Audit Instruments</h1>
            <a href="{{ route('audit-instruments.create') }}" class="btn btn-primary">Create New Instrument</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table">
                    <tr>
                        <th>Code</th>
                        <th>Question</th>
                        <th>Standard</th>
                        <th>Evidence</th>
                        <th>Weight</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($instruments as $inst)
                        <tr>
                            <td><code>{{ $inst->instrument_code }}</code></td>
                            <td>{{ Str::limit($inst->question_text, 60) }}</td>
                            <td>{{ $inst->standar?->standar_name ?? '—' }}</td>
                            <td>{{ $inst->evidence_type_label }}</td>
                            <td>{{ number_format($inst->weight, 2) }}</td>
                            <td>{!! $inst->status_badge !!}</td>
                            <td>
                                <a href="{{ route('audit-instruments.show', $inst) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('audit-instruments.edit', $inst) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('audit-instruments.destroy', $inst) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No instruments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
