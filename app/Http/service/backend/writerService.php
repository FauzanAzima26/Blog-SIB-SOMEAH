<?php

namespace App\Http\service\backend;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class writerService {
    public function serverSide()
    {

        if (request()->ajax()) {
            $totalData = User::count();
            $totalFiltered = $totalData;

            $limit = request()->length;
            $start = request()->start;

            if (empty(request()->search['value'])) {
                $data = User::offset($start)
                    ->limit($limit)
                    ->get(['id', 'name', 'email', 'created_at', 'is_verified', 'verified_at']);
            } else {
                $data = User::filter(request()->search['value'])
                    ->offset($start)
                    ->limit($limit)
                    ->get(['id', 'name', 'email', 'created_at', 'is_verified', 'verified_at']);

                $totalFiltered = $data->count();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->setOffset($start)
                ->editColumn('created_at', function ($data) {
                    return date('d-m-Y H:i:s', strtotime($data->created_at));
                })
                ->editColumn('is_verified', function ($data) {
                    if ($data['is_verified'] == 1) {
                        $data['verified_at'] = date('Y-m-d H:i:s');
                    }
                    return $data->verified_at ? '<span class="badge bg-success">' . date('d-m-Y H:i:s', strtotime($data->verified_at)) . '</span>' : '<span class="badge bg-danger">Unverified</span>';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                    <div class="text-center" width="10%">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary me-2" onclick="editData(this)" data-id="' . $data->id . '">
                                <i class="bi bi-person-check-fill"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteData(this)" data-id="' . $data->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                ';

                    return $actionBtn;
                })
                ->with([
                    'recordsTotal' => $totalData,
                    'recordsFiltered' => $totalFiltered,
                    'start' => $start
                ])
                ->rawColumns(['action', 'is_verified'])
                ->make();
        }
    }

    public function getFirstBy(string $column, string $value)
    {
        return User::where($column, $value)->firstOrFail();
    }

    // public function create(array $data)
    // {
    //     $data['slug'] = Str::slug($data['name']);
    //     return Writer::create($data);
    // }

    public function update(array $data, string $id)
    {
        return User::where('id', $id)->update($data);
    }
}