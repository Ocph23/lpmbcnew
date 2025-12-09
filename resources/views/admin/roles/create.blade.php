@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Role</h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Role Name *</label>
                <select name="role_name" class="form-control" required>
                    <option value="">-- Select System Role --</option>
                    @foreach ($allowedRoles as $roleName)
                        <option value="{{ $roleName }}" {{ old('role_name') == $roleName ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $roleName)) }}
                        </option>
                    @endforeach
                </select>
                <div class="form-text">
                    Only predefined system roles are allowed.
                </div>
                @error('role_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Permissions (one per line)</label>
                <textarea name="permissions[]" class="form-control" rows="6"
                    placeholder="e.g., manage_users&#10;view_reports&#10;create_audit">{{ old('permissions') ? implode("\n", old('permissions')) : '' }}</textarea>
                <div class="form-text">
                    Enter one permission per line. Example: <code>manage_documents</code>, <code>approve_standards</code>
                </div>
                @error('permissions')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
