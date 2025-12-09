@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit User: {{ $user->full_name }}</h1>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Username *</label>
                        <input type="text" name="username" class="form-control"
                            value="{{ old('username', $user->username) }}" maxlength="100" required>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="full_name" class="form-control"
                            value="{{ old('full_name', $user->full_name) }}" maxlength="200" required>
                        @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                            maxlength="150">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">New Password (Optional)</label>
                        <input type="password" name="password" class="form-control" minlength="8">
                        <div class="form-text">Leave blank to keep current password.</div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" class="form-control">
                            <option value="">-- No Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ (old('role_id') ?? $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $role->role_name)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit</label>
                        <select name="unit_id" class="form-control">
                            <option value="">-- Not Assigned --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    {{ (old('unit_id') ?? $user->unit_id) == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->unit_name }} ({{ $unit->unit_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                            {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Active Account</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-warning">Update User</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
