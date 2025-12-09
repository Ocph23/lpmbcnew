@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>User Profile</h1>
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">← Back to List</a>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $user->full_name }}
            </div>
            <div class="card-body">
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Full Name:</strong> {{ $user->full_name }}</p>
                <p><strong>Email:</strong> {{ $user->email ?? '—' }}</p>
                <p><strong>Role:</strong>
                    {{ $user->role?->role_name ? ucfirst(str_replace('_', ' ', $user->role->role_name)) : '—' }}</p>
                <p><strong>Unit:</strong> {{ $user->unit?->unit_name ?? '—' }}</p>
                <p><strong>Status:</strong>
                    @if ($user->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>
                <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="card-footer text-end">
                @if (auth()->id() !== $user->id)
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Delete this user permanently?')">
                            Delete User
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
