<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi LPM UM Papua</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">

            <div class="login-header" style="text-align:center;">
                <img src="{{ asset('images/UMPPapua.png') }}" alt="Logo UM Papua" style="width:100px; margin-bottom:15px;">
                <h2>Registrasi Akun</h2>
                <p>Isi data Anda untuk membuat akun baru</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="login-form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        <label for="name">Nama Lengkap</label>
                    </div>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Username -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                        <label for="username">Username</label>
                    </div>
                    @error('username')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        <label for="email">Email</label>
                    </div>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        <label for="password_confirmation">Konfirmasi Password</label>
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Daftar</span>
                </button>
            </form>

            <div class="signup-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>

        </div>
    </div>
</body>
</html>
