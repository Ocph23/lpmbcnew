@extends('layouts.app')

@section('title', 'Sejarah LPM - Universitas Muhammadiyah Papua')
@section('content')
    <div class="container">
        <h2>
            Sertifikat Akreditasi Institusi<br>
        </h2>

        <div style=" width: 100%; margin-top:10px;">
            <img id="preview" style="width: 100%" src="/storage/sertifikat/{{ $filename }}" alt="Preview" style="">
        </div>


    </div>
@endsection
