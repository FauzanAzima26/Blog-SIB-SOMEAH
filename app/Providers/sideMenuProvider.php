<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\service\frontend\tagService;
use App\Http\service\frontend\articleService;
use App\Http\service\frontend\categoryService;

class sideMenuProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.article._side-menu', function ($view) {
            $articleService = app(articleService::class);
            $view->with('popular_articles', $articleService->popularArticles());

            $categoryService = app(categoryService::class);
            $view->with('categories', $categoryService->randomCategory());

            $tagService = app(tagService::class);
            $view->with('tags', $tagService->randomTag());
        });
    }
}
