@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Unit Details</h1>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $unit->unit_name }}
            </div>
            <div class="card-body">
                <p><strong>Code:</strong> {{ $unit->unit_code }}</p>
                <p><strong>Name:</strong> {{ $unit->unit_name }}</p>
                <p><strong>Type:</strong> {{ $unit->unit_type_label }}</p>
                <p><strong>Parent Unit:</strong> {{ $unit->parent?->unit_name ?? '— (Top-level)' }}</p>
                <p><strong>Head:</strong> {{ $unit->headUser?->name ?? 'Not assigned' }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('units.index') }}" class="btn btn-secondary">← Back</a>
                <a href="{{ route('units.edit', $unit) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('units.destroy', $unit) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this unit?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
