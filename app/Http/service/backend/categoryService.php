<?php

namespace App\Http\service\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class categoryService
{

    public function serverSide()
    {
        // $data = Category::select('name', 'slug')->get();
        // $data = DB::table('categories')->latest()->select('uuid', 'name', 'slug')->get(); 

        // Cara untuk mengoptimalkan waktu menunggu/menerima request
        $totalData = Category::count();
        $totalFiltered = $totalData;
        $limit = request()->length;
        $start = request()->start;

        if(empty(request()->search['value'])) {
            $data = Category::latest()
            ->offset($start)
            ->limit($limit)
            ->get(['uuid', 'name', 'slug']);
        }else{
            $data = Category::filter(request()->search['value'])
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
                        <button type="button" class="btn btn-sm btn-warning" onclick="editCategory(this)" data-id="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="destroyCategory(this)" data-id="' . $row->uuid . '"><i class="fas fa-trash"></i></button>
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

    public function getFirstBy($columns, $value){

        return Category::where($columns, $value)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }

    public function update(array $data, string $id)
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::where('uuid', $id)->update($data);
    }
}