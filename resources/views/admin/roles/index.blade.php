@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Roles</h1>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Create New Role</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table">
                    <tr>
                        <th>Role Name</th>
                        <th>Permissions (Count)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td>
                                <code>{{ $role->role_name }}</code>
                            </td>
                            <td>
                                {{ is_array($role->permissions) ? count($role->permissions) : 0 }} permission(s)
                                @if ($role->permissions)
                                    <small class="text-muted d-block mt-1">
                                        {{ implode(', ', array_slice($role->permissions, 0, 3)) }}{{ count($role->permissions) > 3 ? '...' : '' }}
                                    </small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('roles.show', $role) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning">Edit</a>
                                @if (!in_array($role->role_name, ['admin']))
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this role?')">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No roles defined.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
