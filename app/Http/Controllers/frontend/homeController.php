<?php

namespace App\Http\Controllers\frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
    public function index()
    {

        // artikel terbaru
        $main_post = Article::with('category:id,name', 'user:id,name')
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->first();

        // artikel terpopuler
        $top_view = Article::with('category:id,name', 'tags:id,name')
            ->select('id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->orderBy('views', 'desc')
            ->where('published', true)
            ->where('is_confirm', true)
            ->first();

        // artikel terbaru semua kategori
        $main_post_all = Article::with('category:id,name', 'user:id,name')
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image', 'content', 'published_at')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->where('id', '!=', $main_post->id)
            ->limit(6) // membatasi hanya 6
            ->get();

        // Artikel terbaru berdasarkan kategori
        $post_category = Article::with('category:id,name', 'user:id,name')
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->where('published', true)
            ->where('is_confirm', true)
            ->latest()
            ->get()
            ->groupBy('category_id');

        // Mengambil satu artikel terbaru dari setiap kategori
        $latestArticlePerCategory = $post_category->map(function ($articles) {
            return $articles->first(); // Mengambil artikel terbaru dari setiap kategori
        });


        // Ambil ID artikel terbaru per kategori untuk pengecualian
        $articel_id = $latestArticlePerCategory->pluck('id'); // Ambil ID dari artikel terbaru per kategori

        // artikel terbaru berdasarkan kategori
        $main_post_all_category = Article::with('category:id,name', 'user:id,name')
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image', 'content', 'published_at')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->whereNotIn('id', $articel_id)
            ->limit(6) // membatasi hanya 6
            ->get();

        return view('frontend.home.index', [
            'main_post' => $main_post,
            'top_view' => $top_view,
            'main_post_all' => $main_post_all,
            'categorys' => $latestArticlePerCategory,
            'main_post_all_category' => $main_post_all_category
        ]);
    }
}

