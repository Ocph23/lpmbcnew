@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Unit</h1>

        <form action="{{ route('units.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Unit Code *</label>
                <input type="text" name="unit_code" class="form-control" value="{{ old('unit_code') }}" maxlength="20"
                    required>
            </div>
            <div class="mb-3">
                <label>Unit Name *</label>
                <input type="text" name="unit_name" class="form-control" value="{{ old('unit_name') }}" maxlength="200"
                    required>
            </div>
            <div class="mb-3">
                <label>Type *</label>
                <select name="unit_type" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option value="fakultas" {{ old('unit_type') == 'fakultas' ? 'selected' : '' }}>Fakultas</option>
                    <option value="prodi" {{ old('unit_type') == 'prodi' ? 'selected' : '' }}>Program Studi</option>
                    <option value="bureau" {{ old('unit_type') == 'bureau' ? 'selected' : '' }}>Biro</option>
                    <option value="lab" {{ old('unit_type') == 'lab' ? 'selected' : '' }}>Laboratorium</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Parent Unit</label>
                <select name="parent_unit_id" class="form-control">
                    <option value="">-- None (Top-level) --</option>
                    @foreach ($allUnits as $unit)
                        <option value="{{ $unit->id }}" {{ old('parent_unit_id') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }} ({{ $unit->unit_code }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Head (User)</label>
                <select name="head_user_id" class="form-control">
                    <option value="">-- Not assigned --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('head_user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Save Unit</button>
            <a href="{{ route('units.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
