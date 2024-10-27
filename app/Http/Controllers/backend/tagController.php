<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\tagRequest;
use App\Http\Controllers\Controller;
use App\Http\service\backend\tagService;

class tagController extends Controller
{
    public function __construct(private tagService $tagService)
    {
        $this->middleware('owner');   
    }
    public function index()
    {
        return view('backend.tag.index');
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
    public function store(tagRequest $request)
    {
        sleep(2);

        $data = $request->validated();

        try {
            $this->tagService->create($data);
            return response()->json(['message' => 'Data tag has been created successfully!']);
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
            'data' => $this->tagService->getFirstBy('uuid', $id)
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
    public function update(tagRequest $request, string $id)
    {
        $data = $request->validated();

        $getData = $this->tagService->getFirstBy('uuid', $id);

        try{
            $this->tagService->update($data, $getData->uuid);
            return response()->json(['message' => 'Data tag has been updated successfully!']);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        sleep(2);

        $getData = $this->tagService->getFirstBy('uuid', $id);

        $getData->delete();

        return response()->json(['message' => 'Data tag has been deleted successfully!']);
    }

    public function getData()
    {
        return $this->tagService->serverSide();
    }
}
