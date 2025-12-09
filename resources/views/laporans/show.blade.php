@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Detail Laporan</h1>
            <div>
                <a href="{{ route('laporans.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
                <a href="{{ route('laporans.edit', $laporan) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $laporan->title }}
            </div>
            <div class="card-body">
                <p><strong>Tipe:</strong> {{ $laporan->document_type_label }}</p>
                <p><strong>File:</strong>
                    <a href="{{ route('laporans.download', $laporan) }}" class="link-primary">
                        <i class="fas fa-download"></i> Unduh File
                    </a>
                    ({{ number_format($laporan->file_size / 1024, 2) }} KB)
                </p>
                <p><strong>Deskripsi:</strong></p>
                <div class="p-2 bg-light rounded">
                    {!! nl2br(e($laporan->description ?? '—')) !!}
                </div>
            </div>
            <div class="card-footer text-end">
                <form action="{{ route('laporans.destroy', $laporan) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Hapus laporan ini secara permanen?')">
                        Hapus Laporan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
