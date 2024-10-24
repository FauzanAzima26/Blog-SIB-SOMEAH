<?php

namespace App\Http\service\backend;

use App\Models\Tag;
use App\Models\article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class articleService
{

    public function serverSide()
    {
        // Cara untuk mengoptimalkan waktu menunggu/menerima request
        $totalData = Article::count();
        $totalFiltered = $totalData;
        $limit = request()->length;
        $start = request()->start;

            if (empty(request()->search['value'])) {
                if(auth()->user()->hasRole('owner')) {
                $data = Article::latest()
                    ->with('category:id,name', 'tags:id,name')
                    ->offset($start)
                    ->limit($limit)
                    ->withTrashed()
                    ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published', 'deleted_at']);
                } else {
                    $data = Article::latest()
                    ->with('category:id,name', 'tags:id,name')
                    ->offset($start)
                    ->limit($limit)
                    ->where('user_id', auth()->user()->id)
                    ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published', 'deleted_at']);
                }
            } else {
                if(auth()->user()->hasRole('owner')) {
                $data = Article::filter(request()->search['value'])
                    ->latest()
                    ->with('category:id,name', 'tags:id,name')
                    ->offset($start)
                    ->limit($limit)
                    ->withTrashed()
                    ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published']);
                } else {
                    $data = Article::filter(request()->search['value'])
                    ->latest()
                    ->with('category:id,name', 'tags:id,name')
                    ->offset($start)
                    ->limit($limit)
                    ->where('user_id', auth()->user()->id)
                    ->get(['id', 'uuid', 'title', 'category_id', 'views', 'published']);
                }
    
                $totalFiltered = $data->count();
            }

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn =
                    '<div class="text-center" width="10%>
                    <div class="btn-group">
                        <a href="' . route('admin.article.show', $row->uuid) . '"  class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        <a href="' . route('admin.article.edit', $row->uuid) . '"  class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="destroyArticle(this)" data-id="' . $row->uuid . '"><i class="fas fa-trash"></i></button>
                    </div>
                </div>';
                return $btn;
            })
            ->with([
                'recordsTotal' => $totalData,
                'recordsFiltered' => $totalFiltered,
                'start' => $start,
            ])
            ->setOffset($start)
            ->editColumn('category_id', function ($row) {
                return '<div>
                <span class="badge bg-primary text-white">' . $row->category->name . '</span></div>';
            })
            ->editColumn('published', function ($row) {
                if ($row->published == 1) {
                    return '<div>
                    <span class="badge bg-success text-white">Published</span></div>';
                } else {
                    return '<div>
                    <span class="badge bg-danger text-white">Draft</span></div>';
                }
            })
            ->editColumn('title', function ($data) {
                if (auth()->user()->hasRole('owner') && $data->deleted_at != null) {
                    return '<span class="text-danger">' . $data->title . '</span>';
                } else {
                    return $data->title;
                }
            })
            ->addColumn('tag_id', function ($row) {
                $tagHTML = '';
                foreach ($row->tags as $tag) {
                    $tagHTML .= '<span class="badge bg-primary text-white me-1">' . $tag->name . '</span>';
                }
                return $tagHTML;
            })
            ->rawColumns(['action', 'category_id', 'published', 'tag_id', 'title'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getFirstBy(string $column, string $value, bool $relation = false)
    {
        if ($relation == true && auth()->user()->hasRole('owner')) {
            return Article::with('user:id,name', 'category:id,name', 'tags:id,name')->where($column, $value)->withTrashed()->firstOrFail();
        } elseif ($relation == false && auth()->user()->hasRole('owner')) {
            return Article::where($column, $value)->withTrashed()->firstOrFail();
        } else {
            return Article::where($column, $value)->firstOrFail();
        }
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['title']);

        if ($data['published'] == 1) {
            $data['published_at'] = date('Y-m-d');
        }

        // insert article_tag
        $article = Article::create($data);
        $article->tags()->sync($data['tag_id']);

        return $article;
    }

    public function getCategory()
    {
        return Category::latest()->get(['id', 'name']);
    }

    public function getTag()
    {
        return Tag::latest()->get(['id', 'name']);
    }

    public function delete(string $id)
    {
        $getArticle = $this->getFirstBy('uuid', $id);

        // Storage::disk('public')->delete('images/' . $getArticle->image);

        // $getArticle->tags()->detach();
        $getArticle->tags()->updateExistingPivot($getArticle->tags, ['deleted_at' => now()]); // soft delete
        $getArticle->delete(); // soft delete

        return $getArticle;
    }

    public function update(array $data, string $id)
    {
        $data['slug'] = Str::slug($data['title']);

        if ($data['published'] == 1) {
            $data['published_at'] = date('Y-m-d');
        }

        // insert article_tag
        $article = Article::where('uuid', $id)->firstOrFail();
        $article->update($data);
        $article->tags()->sync($data['tag_id']);

        return $article;
    }

    public function restore(string $id)
    {
        $getArticle = $this->getFirstBy('uuid', $id);
        $getArticle->restore();

        return $getArticle;
    }

    public function forceDelete(string $uuid)
    {
        $getArticle = $this->getFirstBy('uuid', $uuid);

        Storage::disk('public')->delete('images/' . $getArticle->image);

        $getArticle->tags()->detach(); // force delete
        $getArticle->forceDelete(); // force delete

        return $getArticle;
    }
}