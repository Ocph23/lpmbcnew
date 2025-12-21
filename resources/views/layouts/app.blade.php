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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Roboto:wght@300;400;500;900&display=swap">
    {{-- Jika masih ada CSS tambahan manual --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />

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

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    @stack('scripts')


</body>

</html>
