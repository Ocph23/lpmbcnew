@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Laporan</h1>

        <form action="{{ route('laporans.update', $laporan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $laporan->title) }}"
                    maxlength="300" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $laporan->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti File (Opsional)</label>
                <input type="file" name="file" class="form-control">
                <div class="form-text">
                    Biarkan kosong untuk mempertahankan file saat ini.
                </div>
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
            </div>

            <button type="submit" class="btn btn-warning">Perbarui Laporan</button>
            <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
