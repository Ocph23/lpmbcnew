<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPM UM Papua</title>

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/main.css', 'resources/js/main.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Jika masih ada CSS tambahan manual --}}
    @stack('styles')
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Konten halaman (akan diisi dari masing-masing view) --}}
    <main class="flex-grow">
        @yield('content')
    </main>


    @include('partials.footer')
    {{-- JS tambahan manual --}}
    @stack('scripts')
</body>

</html>
