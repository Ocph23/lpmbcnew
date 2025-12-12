<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login UM Papua</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-xl p-8 w-full max-w-md text-center">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/UMPPapua.png') }}" alt="Logo UM Papua" class="h-20 w-auto">
        </div>

        <!-- Judul -->
        <h1 class="text-2xl font-semibold text-gray-800 mb-2">LPM UM Papua</h1>
        <p class="text-gray-500 mb-6">Masukkan Email dan Password</p>

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4 text-left">
            @csrf

            <!-- Email -->
            <div>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="w-full border @error('email') border-red-400 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-400 rounded-lg px-4 py-2 outline-none"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <input id="password" type="password" name="password" placeholder="Password"
                    class="w-full border @error('password') border-red-400 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-400 rounded-lg px-4 py-2 outline-none"
                    required>

                <button type="button" id="togglePassword"
                    class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ingat Saya + Lupa Password -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <span class="text-gray-600">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Lupa Password?</a>
            </div>

            <!-- Tombol Masuk -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-2 transition">
                Masuk
            </button>
        </form>


    </div>

    <!-- Script Show/Hide Password -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
    </script>

</body>

</html>
