<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id',
        'uuid',
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'published',
        'published_at',
        'image',
        'keywords'
    ];

    public static function booted()
    {
        static::creating(function ($article) {
            $article->uuid = Str::uuid();
            $article->user_id = auth()->user()->id;
        });
    }

    public static function filter($search)
    {
        return Article::where('title', 'like', "%{$search}%")
            ->orWhere('slug', 'like', "%{$search}%");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
