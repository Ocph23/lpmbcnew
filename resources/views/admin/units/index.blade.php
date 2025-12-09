@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Units</h1>
        <a href="{{ route('units.create') }}" class="btn btn-primary mb-3">Add New Unit</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Parent</th>
                    <th>Head</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->unit_code }}</td>
                        <td>{{ $unit->unit_name }}</td>
                        <td>{{ $unit->unit_type_label }}</td>
                        <td>{{ $unit->parent?->unit_name ?? '—' }}</td>
                        <td>{{ $unit->headUser?->name ?? '—' }}</td>
                        <td>
                            <a href="{{ route('units.show', $unit) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('units.edit', $unit) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('units.destroy', $unit) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
