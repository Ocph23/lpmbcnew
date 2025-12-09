@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ===================== CARD KALENDER ===================== --}}
    <div class="card shadow mb-4">

        {{-- Header Card --}}
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Kalender Akademik</h6>

            <div class="d-flex gap-2 align-items-center">
                {{-- Tombol Tambah Agenda --}}
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addAgendaModal">
                    + Tambah Agenda
                </button>

                {{-- Navigasi Bulan --}}
                <button id="prevMonth" class="btn btn-sm btn-secondary">‹</button>
                <span id="currentMonth" class="font-weight-bold mx-2"></span>
                <button id="nextMonth" class="btn btn-sm btn-secondary">›</button>
            </div>
        </div>

        {{-- Body Card --}}
        <div class="card-body">
            <div id="calendar">
                {{-- Header Hari --}}
                <div class="calendar-header">
                    <div>Min</div>
                    <div>Sen</div>
                    <div>Sel</div>
                    <div>Rab</div>
                    <div>Kam</div>
                    <div>Jum</div>
                    <div>Sab</div>
                </div>

                {{-- Body Tanggal --}}
                <div id="calendarBody" class="calendar-body"></div>
            </div>
        </div>

    </div>
    {{-- END CARD KALENDER --}}

    {{-- ===================== TABEL DATA AGENDA ===================== --}}
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Agenda</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($agendas as $index => $agenda)
            <tr>
                <td>{{ $index + $agendas->firstItem() }}</td>
                <td>{{ $agenda->title }}</td>
                <td>{{ \Carbon\Carbon::parse($agenda->start_date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($agenda->end_date)->format('d M Y') }}</td>
                <td>{{ $agenda->description }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <!-- Delete Form -->
                    <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                class="btn btn-sm btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="text-center mt-3">
    {{ $agendas->links('pagination::bootstrap-5') }}
</div>

</div>

{{-- ===================== MODAL TAMBAH AGENDA ===================== --}}
<div class="modal fade" id="addAgendaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Agenda Akademik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('agenda.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label>Nama Agenda</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Keterangan (Opsional)</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/calendar.js') }}"></script>
@endpush
