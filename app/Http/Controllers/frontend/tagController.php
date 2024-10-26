<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\service\frontend\tagService;
use App\Http\service\frontend\articleService;

class tagController extends Controller
{
    public function __construct(
        private tagService $tagService,
        private articleService $articleService
    ){}

    public function showByTag(string $slug)
    {
        $tag = $this->tagService->getFirstBy('slug', $slug);

        if ($tag == null) {
            return view('frontend.error.404', [
                'url' => url('/tag/' . $slug),
            ]);
        }

        $articles = $this->articleService->showByTag($slug);

        return view('frontend.tag.show', [
            'tag' => $tag,
            'articles' => $articles,
        ]);
    }
}
