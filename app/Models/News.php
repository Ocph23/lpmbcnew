<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail_path',
        'status',
        'category',
        'author_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi
    public function author()
    {
        return $this->belongsTo(\App\Models\User::class, 'author_id');
    }

    // Akses URL gambar
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path
            ? Storage::url($this->thumbnail_path)
            : 'https://via.placeholder.com/300x200?text=No+Image';
    }

    // Generate slug otomatis
    public static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
            if (static::where('slug', $news->slug)->exists()) {
                $news->slug = $news->slug . '-' . Str::random(5);
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    // Scope
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
