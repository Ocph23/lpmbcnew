@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Standar Details</h1>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $standar->standar_name }}
            </div>
            <div class="card-body">
                <p><strong>Code:</strong> {{ $standar->standar_code }}</p>
                <p><strong>Name:</strong> {{ $standar->standar_name }}</p>
                <p><strong>Category:</strong>
                    <span class="badge bg-{{ $standar->category === 'akademik' ? 'info' : 'secondary' }}">
                        {{ ucfirst($standar->category) }}
                    </span>
                </p>
                <p><strong>Weight:</strong> {{ number_format($standar->weight, 2) }}</p>
                <div>
                    <strong>Description:</strong>
                    <div class="mt-2 p-2 bg-light rounded">
                        {!! nl2br(e($standar->description ?? '—')) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('standars.index') }}" class="btn btn-secondary">← Back to List</a>
                <a href="{{ route('standars.edit', $standar) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('standars.destroy', $standar) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this standar?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
