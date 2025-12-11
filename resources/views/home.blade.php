@extends('layouts.app')

@section('content')
    {{-- Slider (partial) --}}
    @include('partials.slider')

    {{-- Akreditasi (partial) --}}
    @include('partials.akreditasi', ['data' => $data])

    {{-- About (partial) --}}
    @include('partials.about')


    {{-- Sambutan --}}
    <section class="hero p-20 bg-red-700 text-center text-amber-600">
    </section>
@endsection
