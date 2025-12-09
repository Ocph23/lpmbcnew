@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Unggah Laporan Baru</h1>

        <form action="{{ route('laporans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" maxlength="300" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">File *</label>
                <input type="file" name="file" class="form-control" required>
                <div class="form-text">
                    Format: PDF, DOC/X, XLS/X, PPT/X, TXT, JPG, PNG (Maks: 10MB)
                </div>
                @error('file')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe Dokumen *</label>
                <select name="document_type" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="spmi" {{ old('document_type') == 'spmi' ? 'selected' : '' }}>SPMI</option>
                    <option value="spme" {{ old('document_type') == 'spme' ? 'selected' : '' }}>SPME</option>
                    <option value="pusatdata" {{ old('document_type') == 'pusatdata' ? 'selected' : '' }}>Pusat Data
                    </option>
                </select>
                @error('document_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan Laporan</button>
            <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
