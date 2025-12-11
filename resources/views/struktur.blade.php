@extends('layouts.app') {{-- layout utama kamu --}}

@section('title', 'Struktur Organisasi LPM - Universitas Muhammadiyah Papua')

@section('content')
    <div class="container">
        <h2>
            STRUKTUR ORGANISASI<br>
        </h2>

        <div style=" width: 100%; margin-top:10px;">
            <img id="preview" style="width: 100%" src="/storage/{{ $struktur }}" alt="Preview" style="">
        </div>


    </div>
@endsection
