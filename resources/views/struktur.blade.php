@extends('layouts.app') {{-- layout utama kamu --}}

@section('title', 'Struktur Organisasi LPM - Universitas Muhammadiyah Papua')

@section('content')
<div class="lpm-container">
    <img src="{{ asset('images/UMPPapua.png') }}"
         alt="Logo Universitas Muhammadiyah Papua"
         class="lpm-logo">

    <h2 class="lpm-title">
        Struktur Organisasi<br>
        Lembaga Penjamin Mutu (LPM)<br>
        Universitas Muhammadiyah Papua
    </h2>

    <p class="lpm-desc">
        Struktur organisasi Lembaga Penjamin Mutu (LPM) Universitas Muhammadiyah Papua dirancang untuk mendukung efektivitas pelaksanaan sistem penjaminan mutu internal di lingkungan universitas.
        Setiap bagian memiliki tugas dan tanggung jawab yang terintegrasi untuk mewujudkan budaya mutu yang berkelanjutan.
    </p>

    <div class="lpm-org-chart">
        <div class="lpm-box">Rektor Universitas Muhammadiyah Papua</div>
        <div class="lpm-box">Kepala Lembaga Penjamin Mutu (LPM)</div>

        <div class="lpm-sub-boxes">
            <div class="lpm-sub-box">Sekretaris LPM</div>
            <div class="lpm-sub-box">Kepala Bidang Audit Mutu Internal</div>
            <div class="lpm-sub-box">Kepala Bidang Pengembangan Mutu Akademik</div>
            <div class="lpm-sub-box">Kepala Bidang Dokumentasi dan Evaluasi</div>
        </div>
    </div>

    <p class="lpm-desc" style="margin-top: 40px;">
        Setiap bidang bekerja sama dalam pelaksanaan evaluasi diri, audit mutu internal, penyusunan standar mutu, serta pembinaan dan pengembangan sistem penjaminan mutu di seluruh fakultas dan program studi di lingkungan Universitas Muhammadiyah Papua.
    </p>
</div>
@endsection
