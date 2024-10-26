<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\service\frontend\articleService;
use App\Http\service\frontend\categoryService;

class categoryController extends Controller
{
    public function __construct(
        private categoryService $categoryService,
        private articleService $articleService)
    {}

    public function index()
    {
        $categories = $this->categoryService->all();

        return view('frontend.category.index', [
            'categories' => $categories,
        ]);
    }

    public function show(string $slug)
    {
        $category = $this->categoryService->getFirstBy('slug', $slug);

        if ($category == null) {
            return view('frontend.error.404', [
                'url' => url('/category/' . $slug),
            ]);
        }

        $articles = $this->articleService->showByCategory($slug);

        return view('frontend.category.show', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}
