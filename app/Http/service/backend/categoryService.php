<?php

namespace App\Http\service\backend;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
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

        $data = Category::latest()
            ->offset($start)
            ->limit($limit)
            ->get(['uuid', 'name', 'slug']);

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = 
                '<div class="text-center" width="10%>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary" onclick="editCategory(this)" data-id="' . $row->uuid . '"><i class="fas fa-edit"></i></button>
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
}