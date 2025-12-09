@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Standars</h1>
        <a href="{{ route('standars.create') }}" class="btn btn-primary mb-3">Add New Standar</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Weight</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($standars as $standar)
                    <tr>
                        <td>{{ $standar->standar_code }}</td>
                        <td>{{ $standar->standar_name }}</td>
                        <td>{{ $standar->category }}</td>
                        <td>{{ $standar->weight }}</td>
                        <td>
                            <a href="{{ route('standars.show', $standar) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('standars.edit', $standar) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('standars.destroy', $standar) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
