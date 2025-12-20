@extends('layouts.app')

@section('title', 'Berita Terbaru')
@section('meta-description', 'Daftar berita terbaru')

@section('content')
    <div class="berita-container">
        @if ($news->count())
            <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 20px;">
                <div class="col-md-8">
                    <div style="width: 100%">
                        <img style="width: 100%" src="{{ $news->thumbnail_url }}" alt="{{ $news->title }}">
                        <div class="card-content" style="margin-top: 20px">
                            <div style="display:flex; margin-bottom: 30px;">
                                <div class="date-content">
                                    <span>
                                        {{ $news->published_at->format('j') }}
                                    </span>
                                    <span>
                                        {{ $news->published_at->format('F') }}
                                    </span>
                                    <span>
                                        {{ $news->published_at->format('Y') }}
                                    </span>
                                </div>
                                <div>
                                    <a href="{{ route('berita.show', $news->slug) }}"
                                        style="color: inherit; text-decoration: none; font-size: 1.25rem; font-weight: 600;">
                                        {{ $news->title }}
                                    </a>
                                    <ul class="attribute-content">
                                        <li>
                                            <label>Kategori</label>
                                            <span class="badge">{{ ucfirst($news->category) }}</span>
                                        </li>
                                        <li>
                                            <label>Dipublis oleh </label>
                                            <span class="badge">{{ $news->author->name }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <p class="mb-4 text-muted">
                                {!! $news->content !!}
                            </p>

                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Berita Terkait -->
                    @if ($relatedNews->count())
                        <div class="mt-12">
                            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Berita Terkait</h2>
                            <div class="grid grid-cols-1 grid-cols-md-2 grid-cols-lg-3">
                                @foreach ($relatedNews as $news)
                                    <div>
                                        <img style="width: 100%;" src="{{ $news->thumbnail_url }}"
                                            alt="{{ $news->title }}">
                                        <div class="card-content">
                                            <h3 style="margin-top: 0">
                                                <a href="{{ route('berita.show', $news->slug) }}"
                                                    style="color: inherit; text-decoration: none; font-weight: 600; font-size: 1rem;">
                                                    {{ $news->title }}
                                                </a>
                                            </h3>
                                            <div class="text-muted mt-2">
                                                {{ $news->published_at->format('j F Y') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-muted">Tidak ada berita ditemukan.</p>
            </div>
        @endif
    </div>
@endsection

<style>
    .read-more {
        display: inline-block;
        padding: 10px 20px;
        background-color: orange;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        margin: 20px 0;

    }

    .berita-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-direction: column;
        gap: 40px;
        margin-top: 20px
    }

    .date-content {
        border: 2px solid orange;
        border-radius: 5px;
        font-size: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
        margin-right: 10px;
        font-weight: bold;
        color: orange
    }

    .attribute-content {
        list-style-type: none;
        display: flex;
        gap: 10px;
        margin: 0;
    }

    .attribute-content>li {
        padding: 10px;
        min-width: 200px;
        display: flex;
        flex-direction: column;
        border-right: silver 1px solid;
    }

    .attribute-content>li>label {
        color: rgb(155, 155, 155);
    }

    .attribute-content>li>span {
        color: rgb(0, 0, 0);
        font-weight: bold;
    }
</style>
