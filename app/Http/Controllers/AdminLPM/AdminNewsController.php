<?php

namespace App\Http\Controllers\AdminLPM;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminNewsController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $status = $request->input('status');

        $query = News::with('author');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%");
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $news = $query->latest()->paginate(10);

        return Inertia::render('News/Index', [
            'news' => $news,
            'filters' => $request->only(['search', 'category', 'status']),
        ]);
    }

    public function create()
    {
        return Inertia::render('News/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048', // max 2MB
            'status' => 'required|in:draft,published',
            'category' => 'required|string',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('news_thumbnails', 'public');
        }

        News::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'thumbnail_path' => $thumbnailPath,
            'status' => $request->status,
            'category' => $request->category,
            'author_id' => auth()->id(),
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return to_route('news.index')->with('success', 'Berita berhasil disimpan.');
    }

    public function edit(News $news)
    {
        return Inertia::render('News/Edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'category' => 'required|string',
        ]);

        $news = News::findOrFail($id);

        $thumbnailPath = $news->thumbnail_path;

        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('news_thumbnails', 'public');
        }

        $news->update([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'thumbnail_path' => $thumbnailPath,
            'status' => $request->status,
            'category' => $request->category,
            'published_at' => $request->status === 'published' ? ($news->published_at ?: now()) : null,
        ]);

        return to_route('news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->thumbnail_path) {
            Storage::delete($news->thumbnail_path);
        }
        $news->delete();
        return to_route('news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
