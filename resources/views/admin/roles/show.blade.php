@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Role Details</h1>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ ucfirst(str_replace('_', ' ', $role->role_name)) }}
            </div>
            <div class="card-body">
                <p><strong>Role Key:</strong> <code>{{ $role->role_name }}</code></p>
                <p><strong>Permissions:</strong></p>
                @if ($role->permissions && is_array($role->permissions))
                    <ul>
                        @foreach ($role->permissions as $perm)
                            <li><code>{{ $perm }}</code></li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No permissions assigned.</p>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit</a>
                @if (!in_array($role->role_name, ['admin']))
                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this role?')">
                            Delete Role
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
