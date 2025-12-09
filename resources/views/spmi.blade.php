@extends('layouts.app') {{-- Layout utama kamu --}}

@section('title', 'SPMI - Lembaga Penjamin Mutu Universitas Muhammadiyah Papua')

@section('content')

<div class="spmi-container">
    <img src="{{ asset('images/UMPPapua.png') }}" 
         alt="Logo Universitas Muhammadiyah Papua" 
         class="spmi-logo">

    <h2 class="spmi-title">
        Sistem Penjaminan Mutu Internal (SPMI)<br>
        Lembaga Penjamin Mutu (LPM)<br>
        Universitas Muhammadiyah Papua
    </h2>

    <p class="spmi-desc">
        Sistem Penjaminan Mutu Internal (SPMI) merupakan sistem yang dirancang dan dilaksanakan secara mandiri oleh Universitas Muhammadiyah Papua untuk menjamin mutu penyelenggaraan pendidikan tinggi sesuai dengan Standar Nasional Pendidikan Tinggi (SN Dikti) serta nilai-nilai Islam berkemajuan.
    </p>

    <p class="spmi-desc">
        Melalui penerapan SPMI, universitas berkomitmen untuk membangun budaya mutu yang berkelanjutan dan berorientasi pada peningkatan kualitas akademik, tata kelola, penelitian, dan pengabdian kepada masyarakat. 
        LPM berperan sebagai motor penggerak dalam perencanaan, pelaksanaan, evaluasi, pengendalian, dan peningkatan mutu di seluruh unit kerja universitas.
    </p>

    <h3 class="spmi-subtitle">Tujuan SPMI</h3>
    <ul class="spmi-list">
        <li>Menjamin terlaksananya pendidikan tinggi yang bermutu sesuai dengan standar nasional dan standar universitas.</li>
        <li>Meningkatkan efisiensi dan efektivitas penyelenggaraan pendidikan melalui perencanaan dan evaluasi yang sistematis.</li>
        <li>Mewujudkan budaya mutu di seluruh unit kerja dan sivitas akademika.</li>
        <li>Menjadi dasar dalam penyusunan Sistem Penjaminan Mutu Eksternal (SPME) dan akreditasi institusi.</li>
    </ul>

    <div class="spmi-diagram">
        <h4 class="spmi-cycle-title">Siklus PPEPP dalam SPMI</h4>
        <div class="spmi-cycle">
            <div class="spmi-step">Penetapan</div>
            <div class="spmi-step">Pelaksanaan</div>
            <div class="spmi-step">Evaluasi</div>
            <div class="spmi-step">Pengendalian</div>
            <div class="spmi-step">Peningkatan</div>
        </div>
        <p class="spmi-cycle-desc">
            Siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan) merupakan dasar pelaksanaan kegiatan penjaminan mutu internal di Universitas Muhammadiyah Papua.
        </p>
    </div>

    <h3 class="spmi-subtitle">Dokumen dalam SPMI</h3>
    <ul class="spmi-list">
        <li><strong>Kebijakan Mutu:</strong> Landasan umum pelaksanaan penjaminan mutu di universitas.</li>
        <li><strong>Manual Mutu:</strong> Panduan pelaksanaan SPMI dan pembagian tanggung jawab antarunit.</li>
        <li><strong>Standar Mutu:</strong> Tolak ukur yang digunakan untuk menilai mutu kegiatan akademik dan non-akademik.</li>
        <li><strong>Formulir Mutu:</strong> Dokumen pendukung implementasi dan evaluasi standar mutu.</li>
    </ul>

    <p class="spmi-desc" style="margin-top: 30px;">
        Pelaksanaan SPMI secara konsisten akan memastikan Universitas Muhammadiyah Papua menjadi perguruan tinggi yang unggul, islami, dan berdaya saing nasional melalui tata kelola mutu yang profesional dan berkelanjutan.
    </p>
</div>
@endsection
