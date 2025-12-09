@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Laporan</h1>
            <a href="{{ route('laporans.create') }}" class="btn btn-primary">Unggah Laporan</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($laporans->isEmpty())
            <div class="alert alert-info">Belum ada laporan.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Judul</th>
                            <th>Tipe</th>
                            <th>Ukuran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td>{{ $laporan->title }}</td>
                                <td>{{ $laporan->document_type_label }}</td>
                                <td>{{ number_format($laporan->file_size / 1024, 2) }} KB</td>
                                <td>
                                    <a href="{{ route('laporans.show', $laporan) }}" class="btn btn-sm btn-info">Lihat</a>
                                    <a href="{{ route('laporans.download', $laporan) }}"
                                        class="btn btn-sm btn-outline-primary">Download</a>
                                    <a href="{{ route('laporans.edit', $laporan) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('laporans.destroy', $laporan) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus laporan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
