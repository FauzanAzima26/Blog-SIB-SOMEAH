<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\writerRequest;
use App\Http\service\backend\writerService;

class writerController extends Controller
{
    public function __construct(
        private writerService $writerService,
    ) {
        $this->middleware('owner');
    }

    public function index()
    {
        return view('backend.writer.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => $this->writerService->getFirstBy('id', $id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(writerRequest $request, string $id)
    {
        $data = $request->validated();

        $getData = $this->writerService->getFirstBy('id', $id);

        try{
            $this->writerService->update($data, $getData->id);
            return response()->json(['message' => 'Data writer has been updated successfully!']);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getData(Request $request): JsonResponse
    {
        return $this->writerService->serverSide();
    }
}
