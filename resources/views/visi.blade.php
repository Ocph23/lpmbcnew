@extends('layouts.app')

@section('title', 'Visi & Misi LPM - Universitas Muhammadiyah Papua')

@section('content')
<div class="container">
    <img src="{{ asset('images/UMPPapua.png') }}" 
         alt="Logo Universitas Muhammadiyah Papua" 
         class="logo">

    <h2>
        Visi dan Misi<br>
        Lembaga Penjamin Mutu (LPM)<br>
        Universitas Muhammadiyah Papua
    </h2>

    <h3>Visi</h3>
    <p>
        Menjadi lembaga penjamin mutu yang unggul, profesional, dan islami dalam mewujudkan tata kelola Universitas Muhammadiyah Papua yang bermutu tinggi dan berdaya saing nasional.
    </p>

    <h3>Misi</h3>
    <ul>
        <li>Menetapkan dan mengembangkan sistem penjaminan mutu internal yang sesuai dengan Standar Nasional Pendidikan Tinggi (SN Dikti) dan nilai-nilai Islam berkemajuan.</li>
        <li>Melaksanakan evaluasi dan audit mutu akademik serta non-akademik secara berkelanjutan di seluruh unit kerja universitas.</li>
        <li>Meningkatkan kesadaran dan kompetensi sivitas akademika dalam penerapan budaya mutu melalui pelatihan dan pembinaan.</li>
        <li>Menjadi mitra strategis bagi pimpinan universitas dalam perencanaan, pelaksanaan, dan pengendalian mutu.</li>
        <li>Mendorong terciptanya budaya mutu yang berorientasi pada kepuasan seluruh pemangku kepentingan universitas.</li>
    </ul>

    <h3>Tujuan</h3>
    <ul>
        <li>Terwujudnya sistem penjaminan mutu internal yang efektif dan efisien di seluruh unit kerja universitas.</li>
        <li>Terwujudnya peningkatan kualitas akademik dan tata kelola yang berkelanjutan.</li>
        <li>Terbangunnya budaya mutu di lingkungan Universitas Muhammadiyah Papua.</li>
    </ul>
</div>
@endsection
