@extends('layouts.app') {{-- Layout utama kamu --}}

@section('title', 'Rencana Kerja LPM - Universitas Muhammadiyah Papua')

@section('content')
<div class="renker-container">
    <img src="{{ asset('images/UMPPapua.png') }}" 
         alt="Logo Universitas Muhammadiyah Papua" 
         class="renker-logo">

    <h2 class="renker-title">
        Rencana Kerja<br>
        Lembaga Penjamin Mutu (LPM)<br>
        Universitas Muhammadiyah Papua
    </h2>

    <p class="renker-desc">
        Rencana kerja Lembaga Penjamin Mutu (LPM) Universitas Muhammadiyah Papua disusun sebagai pedoman pelaksanaan kegiatan tahunan dalam rangka menjamin peningkatan mutu akademik dan tata kelola universitas secara berkelanjutan. 
        Rencana kerja ini mengacu pada visi, misi, dan tujuan universitas, serta mempertimbangkan hasil evaluasi dan audit mutu internal sebelumnya.
    </p>

    <table class="renker-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Program/Kegiatan</th>
                <th>Tujuan</th>
                <th>Waktu Pelaksanaan</th>
                <th>Penanggung Jawab</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Penyusunan dan peninjauan dokumen standar mutu</td>
                <td>Memastikan kesesuaian standar dengan SN Dikti dan kebutuhan universitas</td>
                <td>Januari – Maret 2025</td>
                <td>Kepala Bidang Pengembangan Mutu Akademik</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Pelaksanaan Audit Mutu Internal (AMI)</td>
                <td>Menilai ketercapaian standar mutu di setiap unit kerja</td>
                <td>April – Juni 2025</td>
                <td>Kepala Bidang Audit Mutu Internal</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Workshop dan pelatihan budaya mutu</td>
                <td>Meningkatkan kompetensi dosen dan tenaga kependidikan dalam penerapan sistem mutu</td>
                <td>Juli – Agustus 2025</td>
                <td>Sekretaris LPM</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Evaluasi dan tindak lanjut hasil AMI</td>
                <td>Menyusun rekomendasi perbaikan mutu berdasarkan hasil audit</td>
                <td>September – Oktober 2025</td>
                <td>Kepala LPM</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Penyusunan laporan tahunan penjaminan mutu</td>
                <td>Melaporkan capaian kegiatan LPM dan rencana peningkatan mutu berikutnya</td>
                <td>November – Desember 2025</td>
                <td>Sekretariat LPM</td>
            </tr>
        </tbody>
    </table>

    <p class="renker-desc" style="margin-top: 40px;">
        Rencana kerja ini bersifat dinamis dan dapat disesuaikan dengan perkembangan kebutuhan serta kebijakan Universitas Muhammadiyah Papua, dengan tetap berlandaskan pada prinsip peningkatan mutu yang berkelanjutan.
    </p>
</div>
@endsection
