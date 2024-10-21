<?php

namespace App\Http\service\backend;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class tagService {

    public function serverSide()
    {
        // $data = Tag::select('name', 'slug')->get();
        // $data = DB::table('categories')->latest()->select('uuid', 'name', 'slug')->get(); 

        // Cara untuk mengoptimalkan waktu menunggu/menerima request
        $totalData = Tag::count();
        $totalFiltered = $totalData;
        $limit = request()->length;
        $start = request()->start;

        if(empty(request()->search['value'])) {
            $data = Tag::latest()
            ->offset($start)
            ->limit($limit)
            ->get(['uuid', 'name', 'slug']);
        }else{
            $data = Tag::filter(request()->search['value'])
            ->latest()
            ->offset($start)
            ->limit($limit)
            ->get(['uuid', 'name', 'slug']);

            $totalFiltered = $data->count();
        }

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn =
                    '<div class="text-center" width="10%>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary" onclick="showTag(this)" data-id="' . $row->uuid . '"><i class="fas fa-eye"></i></button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="editTag(this)" data-id="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="destroyTag(this)" data-id="' . $row->uuid . '"><i class="fas fa-trash"></i></button>
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
            ->addIndexColumn()
            ->make(true);
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return Tag::create($data);
    }

    public function getFirstBy($columns, $value){

        return Tag::where($columns, $value)->firstOrFail();
    }

    public function update(array $data, string $id)
    {
        $data['slug'] = Str::slug($data['name']);
        return Tag::where('uuid', $id)->update($data);
    }
}