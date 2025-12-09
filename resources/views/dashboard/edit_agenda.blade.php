@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3>Edit Agenda Akademik</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('agenda.update', $agenda->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Agenda</label>
            <input type="text" name="title" class="form-control" value="{{ $agenda->title }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ $agenda->start_date->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-control" value="{{ $agenda->end_date->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="description" class="form-control">{{ $agenda->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
