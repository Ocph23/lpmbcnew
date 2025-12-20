<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $query = News::published()->latest();

        if ($category) {
            $query->where('category', $category);
        }

        $news = $query->paginate(9);
        $categories = News::select('category')
            ->groupBy('category')
            ->pluck('category');

        $newNews = News::published()
            ->latest()
            ->take(3)
            ->get();


        return view('berita', compact('news', 'categories', 'category', 'newNews'));
    }

    public function show(string $slug)
    {
        $news = News::published()->where('slug', $slug)->firstOrFail();
        $relatedNews = News::published()
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(3)
            ->get();

        return view('beritadetail', compact('news', 'relatedNews'));
    }
}
