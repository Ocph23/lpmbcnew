@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Audit Schedules</h1>
            <a href="{{ route('audit-schedules.create') }}" class="btn btn-primary">Create New Schedule</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table">
                    <tr>
                        <th>Code</th>
                        <th>Audit Name</th>
                        <th>Period</th>
                        <th>Date Range</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->schedule_code }}</td>
                            <td>{{ $schedule->audit_name }}</td>
                            <td>{{ $schedule->audit_period_label }}</td>
                            <td>
                                {{ $schedule->start_date->format('d M Y') }} –<br>
                                {{ $schedule->end_date->format('d M Y') }}
                            </td>
                            <td>{!! $schedule->status_badge !!}</td>
                            <td>{{ $schedule->createdBy?->name ?? '—' }}</td>
                            <td>
                                <a href="{{ route('audit-schedules.show', $schedule) }}"
                                    class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('teams.index', $schedule) }}" class="btn btn-sm btn-success">Teams</a>
                                <a href="{{ route('results.index', $schedule) }}"
                                    class="btn btn-sm btn-success">Results</a>
                                <a href="{{ route('audit-schedules.edit', $schedule) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('audit-schedules.destroy', $schedule) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this schedule?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No audit schedules found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
