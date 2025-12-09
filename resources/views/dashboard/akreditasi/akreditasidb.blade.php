@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4 font-bold text-xl">Kelola Data Akreditasi Nasional BAN-PT/LAM Program Studi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('dashboard.akreditasidb.update') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>Unggul</label>
                <input type="number" name="unggul" class="form-control" value="{{ $data->unggul }}">
            </div>

            <div class="col-md-4 mb-3">
                <label>Peringkat A</label>
                <input type="number" name="peringkat_a" class="form-control" value="{{ $data->peringkat_a }}">
            </div>

            <div class="col-md-4 mb-3">
                <label>Baik Sekali</label>
                <input type="number" name="baik_sekali" class="form-control" value="{{ $data->baik_sekali }}">
            </div>

            <div class="col-md-4 mb-3">
                <label>Peringkat Baik</label>
                <input type="number" name="peringkat_baik" class="form-control" value="{{ $data->peringkat_baik }}">
            </div>

            <div class="col-md-4 mb-3">
                <label>Peringkat B</label>
                <input type="number" name="peringkat_b" class="form-control" value="{{ $data->peringkat_b }}">
            </div>

        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Simpan Perubahan
        </button>

    </form>
</div>
@endsection
