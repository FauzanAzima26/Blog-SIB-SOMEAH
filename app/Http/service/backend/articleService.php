<?php

namespace App\Http\service\backend;

use App\Models\article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class articleService {

    public function serverSide()
    {
        // Cara untuk mengoptimalkan waktu menunggu/menerima request
        $totalData = Article::count();
        $totalFiltered = $totalData;
        $limit = request()->length;
        $start = request()->start;

        if(empty(request()->search['value'])) {
            $data = Article::latest()
            ->with('category:id,name', 'tags:id,name')
            ->offset($start)
            ->limit($limit)
            ->get(['uuid', 'title', 'category_id', 'views', 'published']);
        }else{
            $data = Article::filter(request()->search['value'])
            ->latest()
            ->with('category:id,name', 'tags:id,name')
            ->offset($start)
            ->limit($limit)
            ->get(['uuid', 'title', 'category_id', 'views', 'published']);

            $totalFiltered = $data->count();
        }

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn =
                    '<div class="text-center" width="10%>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" onclick="editArticle(this)" data-id="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
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
                <span class="badge bg-primary text-white">' . $row->category->name .'</span></div>';
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
            ->addColumn('tag_id', function ($row) {
                $tagHtml = '';
                foreach ($row->tags as $tag) {
                    $tagHtml .= '<span class="badge bg-primary text-white">' . $tag->name . '</span>';
                }
                return $tagHtml;
            })
            ->rawColumns(['action', 'category_id', 'published', 'tag_id'])
            ->addIndexColumn()
            ->make(true);
    }
}