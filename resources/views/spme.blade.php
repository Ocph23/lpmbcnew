@extends('layouts.app') {{-- memakai layout utama proyekmu --}}

@section('title', 'SPME - Lembaga Penjamin Mutu Universitas Muhammadiyah Papua')

@section('content')

<div class="spme-container">
    <img src="{{ asset('images/UMPPapua.png') }}" 
         alt="Logo Universitas Muhammadiyah Papua" 
         class="spme-logo">

    <h2 class="spme-title">
        Sistem Penjaminan Mutu Eksternal (SPME)<br>
        Lembaga Penjamin Mutu (LPM)<br>
        Universitas Muhammadiyah Papua
    </h2>

    <p class="spme-desc">
        Sistem Penjaminan Mutu Eksternal (SPME) adalah mekanisme penjaminan mutu yang dilakukan oleh pihak luar universitas, baik pemerintah, lembaga akreditasi nasional, maupun asosiasi profesional, untuk menilai kesesuaian penyelenggaraan pendidikan tinggi dengan standar nasional dan internasional. 
        SPME melengkapi Sistem Penjaminan Mutu Internal (SPMI) dalam rangka meningkatkan transparansi, akuntabilitas, dan kredibilitas universitas.
    </p>

    <h3 class="spme-subtitle">Tujuan SPME</h3>
    <ul class="spme-list">
        <li>Menjamin kesesuaian program studi dan institusi dengan standar akreditasi nasional (BAN-PT) dan internasional.</li>
        <li>Meningkatkan reputasi Universitas Muhammadiyah Papua di tingkat nasional dan internasional.</li>
        <li>Memberikan masukan eksternal untuk peningkatan mutu akademik, penelitian, dan pengabdian masyarakat.</li>
        <li>Mendorong universitas menerapkan praktik terbaik dalam tata kelola, kurikulum, dan manajemen mutu.</li>
    </ul>

    <div class="spme-diagram">
        <h4 class="spme-cycle-title">Proses Penjaminan Mutu Eksternal</h4>
        <div class="spme-cycle">
            <div class="spme-step">Persiapan Dokumen</div>
            <div class="spme-step">Audit/Visitasi Tim Eksternal</div>
            <div class="spme-step">Evaluasi dan Penilaian</div>
            <div class="spme-step">Rekomendasi Perbaikan</div>
            <div class="spme-step">Tindak Lanjut</div>
        </div>
        <p class="spme-cycle-desc">
            Siklus ini membantu universitas menindaklanjuti temuan dan rekomendasi eksternal sehingga mutu akademik dan tata kelola terus meningkat.
        </p>
    </div>

    <h3 class="spme-subtitle">Dokumen Pendukung SPME</h3>
    <ul class="spme-list">
        <li><strong>Laporan SPMI:</strong> Laporan internal yang menjadi bahan evaluasi eksternal.</li>
        <li><strong>Dokumen Akreditasi:</strong> Bukti capaian standar nasional dan internasional.</li>
        <li><strong>Laporan Penelitian dan Pengabdian:</strong> Dokumentasi kegiatan akademik yang dinilai oleh tim eksternal.</li>
        <li><strong>Rencana Peningkatan Mutu:</strong> Dokumen tindak lanjut hasil evaluasi eksternal.</li>
    </ul>

    <p class="spme-desc" style="margin-top: 30px;">
        Dengan implementasi SPME yang efektif, Universitas Muhammadiyah Papua dapat memastikan mutu pendidikan tinggi yang sesuai standar nasional dan internasional, sekaligus meningkatkan kepercayaan masyarakat, mahasiswa, dan pemangku kepentingan.
    </p>
</div>
@endsection