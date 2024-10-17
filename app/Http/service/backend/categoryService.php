<?php

namespace App\Http\service\backend;

use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class categoryService
{

    public function serverSide()
    {
        $data = Category::select('name', 'slug')->get();

        return DataTables::of($data)
            ->addColumn('action', function($row){
                $btn = '<a href="/edit/'.$row->id.'" class="edit btn btn-success btn-sm"><i class="fa fa-edit"></i></a>';
                $btn .= ' <a href="/delete/'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->addIndexColumn()
            ->make(true);
    }
}