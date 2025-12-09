@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Standard</h1>
        <form action="{{ route('standars.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Standard Code</label>
                <input type="text" name="standar_code" class="form-control" required maxlength="20">
            </div>
            <div class="mb-3">
                <label>Standard Name</label>
                <input type="text" name="standar_name" class="form-control" required maxlength="200">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select name="category" class="form-control" required>
                    <option value="akademik">Akademik</option>
                    <option value="non-akademik">Non-Akademik</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Weight</label>
                <input type="number" step="0.1" name="weight" class="form-control" value="1.0" min="0"
                    required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('standars.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
