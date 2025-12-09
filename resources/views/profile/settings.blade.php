@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Security</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header">
            <strong>Ubah Password</strong>
        </div>

        <div class="card-body">
            <form action="{{ route('settings.password') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" name="old_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>

                <button class="btn btn-primary">Update Password</button>

            </form>
        </div>
    </div>

</div>
@endsection
