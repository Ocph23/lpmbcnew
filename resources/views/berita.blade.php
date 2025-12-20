@extends('layouts.app')

@section('title', 'Berita Terbaru')
@section('meta-description', 'Daftar berita terbaru')

@section('content')
    <div class="berita-container">
        <!-- Filter Kategori -->
        <div class="mb-6">
            <div class="menu-filter">
                <a href="{{ route('berita.index') }}" class="btn {{ !$category ? '' : 'btn-outline' }}">Semua</a>
                @foreach ($categories as $cat)
                    <a href="{{ route('berita.index', ['category' => $cat]) }}"
                        class="btn {{ $category === $cat ? '' : 'btn-outline' }}">
                        {{ ucfirst($cat) }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Daftar Berita -->
        @if ($news->count())
            <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 20px;">
                <div class="col-md-8">
                    @foreach ($news as $item)
                        <div style="width: 100%; margin-bottom: 20px;">
                            <img style="width: 100%" src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}">
                            <div class="card-content" style="margin-top: 20px">
                                <div style="display:flex; margin-bottom: 30px;">
                                    <div class="date-content">
                                        <span>
                                            {{ $item->published_at->format('j') }}
                                        </span>
                                        <span>
                                            {{ $item->published_at->format('F') }}
                                        </span>
                                        <span>
                                            {{ $item->published_at->format('Y') }}
                                        </span>
                                    </div>
                                    <div>
                                        <a href="{{ route('berita.show', $item->slug) }}"
                                            style="color: inherit; text-decoration: none; font-size: 1.25rem; font-weight: 600;">
                                            {{ $item->title }}
                                        </a>
                                        <ul class="attribute-content">
                                            <li>
                                                <label>Kategori</label>
                                                <span class="badge">{{ ucfirst($item->category) }}</span>
                                            </li>
                                            <li>
                                                <label>Dipublis oleh </label>
                                                <span class="badge">{{ $item->author->name }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <p class="mb-4 text-muted">
                                    {{ Str::limit($item->excerpt ?: $item->content, 120) }}
                                </p>

                                <a href="{{ route('berita.show', $item->slug) }}" class="read-more">
                                    Read More...
                                </a>

                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    @if ($newNews->count())
                        <div>
                            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Berita Terbaru</h2>
                            <div class="grid grid-cols-1 grid-cols-md-2 grid-cols-lg-3">
                                @foreach ($newNews as $item)
                                    <div style="margin-bottom: 20px">
                                        <img style="width: 100%;" src="{{ $item->thumbnail_url }}"
                                            alt="{{ $item->title }}">
                                        <div class="card-content">
                                            <h4 style="margin-top: 0">
                                                <a href="{{ route('berita.show', $item->slug) }}"
                                                    style="color: inherit; text-decoration: none; font-weight: 600; font-size: 1rem;">
                                                    {{ $item->title }}
                                                </a>
                                            </h4>
                                            <div style="display: flex; justify-content: end; color:rgb(112, 114, 116)">
                                                {{ $item->published_at->format('j F Y') }}
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            @if ($news->hasPages())
                <div class="pagination">
                    {{ $news->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-muted">Tidak ada berita ditemukan.</p>
            </div>
        @endif
    </div>
@endsection



<style>
    .menu-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .menu-filter>a {
        background-color: orange;
        color: white;
    }

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
        margin-top: 20px;
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
