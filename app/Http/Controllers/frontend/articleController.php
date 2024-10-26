<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\service\frontend\articleService;
use App\Http\service\frontend\categoryService;

class articleController extends Controller
{
    public function __construct(
        private articleService $articleService,
        private categoryService $categoryService    
    ){}

    public function index()
    {
        $articles = $this->articleService->all();

        return view('frontend.article.index', [
            'articles' => $articles,
        ]);
    }

    public function show(string $slug)
    {
        // eloquent
        $article = $this->articleService->getFirstBy('slug', $slug, true);

        if ($article == null) {
            return view('frontend.error.404', [
                'url' => url('/article/' . $slug),
            ]);
        }

        // add view
        $article->increment('views');

        // get category
        $categories = $this->categoryService->randomCategory();

        return view('frontend.article.show', [
            'article' => $article,
            'related_articles' => $this->articleService->relatedArticles($article->slug),
        ]);
    }
}
