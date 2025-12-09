@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Upload New Document</h1>

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Document Code *</label>
                        <input type="text" name="document_code" class="form-control" value="{{ old('document_code') }}"
                            maxlength="50" required>
                        @error('document_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                            maxlength="300" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File *</label>
                        <input type="file" name="file" class="form-control" required>
                        <div class="form-text">Allowed: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Max: 10MB)</div>
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Document Type *</label>
                        <select name="document_type" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="kebijakan" {{ old('document_type') == 'kebijakan' ? 'selected' : '' }}>Kebijakan
                            </option>
                            <option value="sop" {{ old('document_type') == 'sop' ? 'selected' : '' }}>SOP</option>
                            <option value="formulir" {{ old('document_type') == 'formulir' ? 'selected' : '' }}>Formulir
                            </option>
                            <option value="bukti" {{ old('document_type') == 'bukti' ? 'selected' : '' }}>Bukti</option>
                        </select>
                        @error('document_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit *</label>
                        <select name="unit_id" class="form-control" required>
                            <option value="">-- Select Unit --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->unit_name }} ({{ $unit->unit_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Related Standar</label>
                        <select name="standar_id" class="form-control">
                            <option value="">-- Optional --</option>
                            @foreach ($standars as $standar)
                                <option value="{{ $standar->id }}"
                                    {{ old('standar_id') == $standar->id ? 'selected' : '' }}>
                                    {{ $standar->standar_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Validity Date (Expiry)</label>
                        <input type="date" name="validity_date" class="form-control" value="{{ old('validity_date') }}">
                        @error('validity_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Version</label>
                        <input type="number" name="version" class="form-control" value="{{ old('version', 1) }}"
                            min="1">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Upload Document</button>
                <a href="{{ route('documents.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
