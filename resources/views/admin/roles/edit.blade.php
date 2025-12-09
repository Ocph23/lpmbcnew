@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Role: {{ $role->role_name }}</h1>

        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Role Name *</label>
                <select name="role_name" class="form-control" required>
                    @foreach ($allowedRoles as $roleName)
                        <option value="{{ $roleName }}"
                            {{ (old('role_name') ?? $role->role_name) == $roleName ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $roleName)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Permissions (one per line)</label>
                <textarea name="permissions[]" class="form-control" rows="6">{{ is_array($role->permissions) ? implode("\n", $role->permissions) : '' }}</textarea>
                <div class="form-text">Enter one permission per line.</div>
            </div>

            <button type="submit" class="btn btn-warning">Update Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
