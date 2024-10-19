<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Http\service\backend\categoryService;
use Yajra\DataTables\Facades\DataTables;

class categoryController extends Controller
{
    public function __construct(
        private categoryService $categoryService
    ) {
    }

    public function index()
    {
        return view('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoryRequest $request)
    {
        sleep(2);

        $data = $request->validated();

        try {
            $this->categoryService->create($data);
            return response()->json(['message' => 'Data category has been created successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => $this->categoryService->getFirstBy('uuid', $id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoryRequest $request, string $id)
    {
        $data = $request->validated();

        $getData = $this->categoryService->getFirstBy('uuid', $id);

        try{
            $this->categoryService->update($data, $getData->uuid);
            return response()->json(['message' => 'Data category has been updated successfully!']);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // loading
        sleep(2);

        $getData = $this->categoryService->getFirstBy('uuid', $id);

        $getData->delete();

        return response()->json(['message' => 'Data category has been deleted successfully!']);
    }

    public function getData()
    {

        return $this->categoryService->serverSide();
    }
}
