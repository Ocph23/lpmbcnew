@extends('layouts.app') {{-- Layout utama kamu --}}

@section('title', 'Rencana Kerja LPM - Universitas Muhammadiyah Papua')

@section('content')
    <div class="renker-container">
        <h2 class="renker-title">
            DOWNLOAD DOCUMENT
        </h2>



        <table class="renker-table">
            <thead>
                <thead class="table">
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Unit</th>
                        <th>Valid Until</th>
                        <th>Version</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </thead>
            <tbody>
                @forelse($documents as $document)
                    <tr>
                        <td>{{ Str::limit($document->title, 40) }}</td>
                        <td>{{ $document->document_type_label }}</td>
                        <td>{{ $document->unit->unit_name ?? '—' }}</td>
                        <td>{{ $document->validity_date ? $document->validity_date->format('d M Y') : '—' }}</td>
                        <td>v{{ $document->version }}</td>
                        <td>
                            <a href="{{ route('documents.download', $document) }}" class="bg-red-400">Download</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No documents found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
