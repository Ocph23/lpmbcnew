<header>
    <nav class="header-nav" role="navigation">
        <!-- LOGO & TITLE -->
        <div class="nav-logo">
            <a href="#">
                <img src="{{ asset('images/UMPPapua.png') }}" alt="Logo Jemaat Alfa Omega" />
            </a>
            <a href="#" class="nav-title">LPM UM Papua</a>
        </div>

        <!-- MENU TENGAH -->
        <div class="nav-left">
            <a href="{{ route('home') }}">Beranda</a>

            <!-- Profil -->
            <div class="dropdown">
                <a href="#">Profil</a>
                <div class="dropdown-content">
                    <a href="{{ route('sejarah') }}">Sejarah</a>
                    <a href="{{ route('visi') }}">Visi & Misi</a>
                    <a href="{{ route('struktur') }}">Struktur Organisasi</a>
                    <a href="{{ route('renker') }}">Rencana Kerja</a>
                </div>
            </div>

            <!-- Bidang -->
            <div class="dropdown">
                <a href="#">Bidang</a>
                <div class="dropdown-content">
                    <a href="{{ route('spmi') }}">SPMI</a>
                    <a href="{{ route('spme') }}">SPME</a>
                    <a href="{{ route('pusatdata') }}">Pusat Data</a>
                </div>
            </div>

            <!-- Laporan -->
            <div class="dropdown">
                <a href="#">Laporan</a>
                <div class="dropdown-content">
                    <a href="/laporan/spmi">Bidang SPMI</a>
                    <a href="/laporan/spme">Bidang SPME</a>
                    <a href="/laporan/pusatdata">Pusat data</a>
                </div>
            </div>

            <!-- Akreditasi -->
            <div class="dropdown">
                <a href="#">Akreditasi</a>
                <div class="dropdown-content">
                    <a href="{{ route('akreditasi.institusi') }}">Institusi</a>
                    <a href="#">Program Studi</a>
                    <a href="#">Instrumen Akreditasi</a>
                </div>
            </div>

            <!-- Mutu -->
            <div class="dropdown">
                <a href="#">Mutu</a>
                <div class="dropdown-content">
                    <a href="#">Kebijakan Mutu</a>
                    <a href="#">Standar Mutu</a>
                    <a href="#">Manual Mutu</a>
                    <a href="#">Capaian Sasaran Mutu</a>
                    <a href="#">Dokumen ISO</a>
                    <a href="#">Formulir Mutu</a>
                </div>
            </div>

            <a href="#">Berita</a>
            <a href="/downloads">Download</a>
        </div>

        <!-- MENU KANAN -->
        <div class="nav-right">
            <a href="{{ route('login') }}" class="btn primary">Login</a>
            {{-- <a href="#" class="btn primary">Register</a> --}}
            <button id="hamburgerBtn" class="hamburger" aria-label="Buka menu">&#9776;</button>
        </div>
    </nav>

    <!-- BACKDROP -->
    <div id="backdrop" class="backdrop"></div>

    <!-- MOBILE NAV -->
    <div id="mobileNav" class="mobile-nav" aria-hidden="true">
        <button id="closeMobileNav" class="close-btn" aria-label="Tutup menu">&times;</button>
        <a href="#">Beranda</a>
        <a href="#">Profil</a>
        <a href="#">Perancanaan</a>
        <a href="#">Dokumen</a>
        <a href="#">Survey Kepuasan</a>
        <a href="#">Monitoring dan Evaluasi</a>
    </div>
</header>
