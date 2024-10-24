<?php

namespace App\Http\Controllers\backend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\articleRequest;
use App\Http\service\backend\imageService;
use App\Http\service\backend\articleService;

class articleController extends Controller
{
    public function __construct(
        private articleService $articleService,
        private imageService $imageService
        ){ $this->middleware('writer'); }
    
    public function index()
    {
        return view('backend.article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.article.create', [
            'categories' => $this->articleService->getCategory(),
            'tags' => $this->articleService->getTag()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(articleRequest $request)
    {
        $data = $request->validated();

        try {
            $data['image'] = $this->imageService->storeImage($data);

            $this->articleService->create($data);

            return response()->json([
                'message' => 'Data Artikel Berhasil Ditambahkan...'
            ]);
        } catch (\Exception $error) {
            $this->imageService->deleteImage($data['image'], 'images');

            return response()->json([
                'message' => 'Data Artikel Gagal Ditambahkan...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = $this->articleService->getFirstBy('uuid', $id);
        


        return view('backend.article.show', [
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = $this->articleService->getFirstBy('uuid', $id, true);

        return view('backend.article.edit', [
            'article' => $article,
            'categories' => $this->articleService->getCategory(),
            'tags' => $this->articleService->getTag()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(articleRequest $request, string $id)
    {
        $data = $request->validated();

        $getArticle = $this->articleService->getFirstBy('uuid', $id);

        try {
           if ($request->hasFile('image')) {
                $data['image'] = $this->imageService->storeImage($data, $getArticle->image);
           }

            $this->articleService->update($data, $id);

            return response()->json([
                'message' => 'Data Artikel Berhasil Diubah...'
            ]);
        } catch (\Exception $error) {
            $this->imageService->deleteImage($data['image'], 'images');

            return response()->json([
                'message' => 'Data Artikel Gagal Diubah...' . $error->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $article = $this->articleService->getFirstBy('uuid', $id, true);

        // Gate::authorize('view', $article);

        $this->articleService->delete($id);

        return response()->json(['message' => 'Data Artikel Berhasil Dihapus...']);
    }

    public function getData(){

        return $this->articleService->serverSide(); 
    }
}
