<header>
    <nav class="header-nav" role="navigation">
        <!-- LOGO & TITLE -->
        <div class="nav-logo">
            <a href="/">
                <img src="{{ asset('images/UMPPapua.png') }}" alt="UMPPapua" />
            </a>
            <a href="/" class="nav-title">LPM UM Papua</a>
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
                </div>
            </div>

            <!-- Bidang -->
            <div class="dropdown">
                <a href="#">AMI</a>
                <div class="dropdown-content">
                    <a href="{{ route('jadwal-audits.index') }}">Jadwal Audit</a>
                    <a href="{{ route('auditors.index') }}">Auditor</a>
                    <a href="{{ route('auditis.index') }}">Auditi</a>
                    <a onclick="openUrlInNewTab('/instrumentami')" class="cursor-pointer">Instrument
                        AMI</a>
                    <a onclick="openUrlInNewTab('/hasilami')" class="cursor-pointer">Unggah Dokumen Hasil
                        AMI</a>

                </div>
            </div>


            {{-- <!-- Akreditasi -->
            <div class="dropdown">
                <a href="#">Akreditasi</a>
                <div class="dropdown-content">
                    <a href="{{ route('akreditasi.institusi') }}">Sertifikat Akreditasi</a>
                    <a href="#">Instrumen Akreditasi</a>
                </div>
            </div> --}}

            <!-- Mutu -->
            <div class="dropdown">
                <a href="#">Pengolahan Mutu</a>
                <div class="dropdown-content">
                    <a>SPMI</a>
                    @foreach ([['kode' => 'spmi', 'kategori' => 'kebijakan_spmi', 'title' => 'Kebijakan SPMI', 'unit' => false], ['kode' => 'spmi', 'kategori' => 'manual_mutu', 'title' => 'Manual Mutu', 'unit' => false], ['kode' => 'spmi', 'kategori' => 'standar_spmi', 'title' => 'Standar SPMI', 'unit' => false], ['kode' => 'spmi', 'kategori' => 'prosedur_mutu', 'title' => 'Prosedur Mutu', 'unit' => false], ['kode' => 'spmi', 'kategori' => 'formulir_spmi', 'title' => 'Formulir SPMI', 'unit' => true], ['kode' => 'spmi', 'kategori' => 'prosedur_kerja', 'title' => 'Prosedur Kerja', 'unit' => true], ['kode' => 'spmi', 'kategori' => 'standar_upps_unit', 'title' => 'Standar UPPS|Unit', 'unit' => true]] as $mutu)
                        <a style="margin-left: 20px"
                            href="/pengolahanmutu/{{ $mutu['kategori'] }}">{{ $mutu['title'] }}</a>
                    @endforeach

                    <a>SPME</a>
                    @foreach ([['kode' => 'spme', 'kategori' => 'borang_akreditasi', 'title' => 'Borang Akreditasi', 'unit' => false], ['kode' => 'spme', 'kategori' => 'hasil_akreditasi', 'title' => 'Hasil Akreditasi', 'unit' => false], ['kode' => 'spme', 'kategori' => 'tindaklanjut_akreditasi', 'title' => 'Tindaklanjut Akreditasi', 'unit' => false]] as $mutu)
                        <a style="margin-left: 20px"
                            href="/pengolahanmutu/{{ $mutu['kategori'] }}">{{ $mutu['title'] }}</a>
                    @endforeach
                </div>
            </div>
            <a href="/berita">Berita</a>
            <a href="/layananlpm">Layanan LPM</a>
        </div>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-teal-400">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @endauth


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


<script>
    function openUrlInNewTab(url) {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                window.open(data.url, '_blank'); // Opens the URL in a new tab
            });

    }
</script>
