@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">

        <!-- Profile Picture -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="m-0 fw-bold text-primary">Profile Picture</h6>
                </div>
                <div class="card-body text-center">

                    <img id="preview-image"
                         src="{{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('img/undraw_profile.svg') }}"
                         class="rounded-circle mb-3" 
                         width="150" height="150">

                    <p class="text-muted small">JPG atau PNG maksimal 5 MB</p>

                    <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" onchange="previewImage(event)">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary w-100">Upload new image</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Account Details -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="m-0 fw-bold text-primary">Account Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username', Auth::user()->username ?? Auth::user()->name) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                       value="{{ old('first_name', Auth::user()->first_name) }}">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                       value="{{ old('last_name', Auth::user()->last_name) }}">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization</label>
                            <input type="text" name="organization" id="organization" class="form-control @error('organization') is-invalid @enderror"
                                   value="{{ old('organization', Auth::user()->organization) }}">
                            @error('organization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror"
                                       value="{{ old('location', Auth::user()->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', Auth::user()->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" name="birthday" id="birthday" class="form-control @error('birthday') is-invalid @enderror"
                                       value="{{ old('birthday', Auth::user()->birthday) }}">
                                @error('birthday')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if(file && (file.size <= 5 * 1024 * 1024) && ['image/jpeg','image/png'].includes(file.type)) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview-image').src = reader.result;
            }
            reader.readAsDataURL(file);
        } else {
            alert('File harus JPG/PNG dan maksimal 5 MB');
            event.target.value = '';
        }
    }
</script>
@endsection
