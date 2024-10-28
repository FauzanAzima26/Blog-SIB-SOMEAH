<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\service\backend\tagService;
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
    public function update(Request $request, string $id)
    {
        // Validasi input untuk memastikan 'is_verified' ada dan merupakan boolean
        $request->validate([
            'is_verified' => 'required|boolean', // Pastikan is_verified ada dan bertipe boolean
        ]);

        // Ambil data pengguna berdasarkan ID
        $getData = $this->writerService->getFirstBy('id', $id);

        try {
            // Ambil nilai is_verified dari request
            $isVerified = $request->input('is_verified');

            // Panggil metode update pada writerService
            $this->writerService->update($isVerified, $getData->id);

            return response()->json(['message' => 'Data category has been updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500); // Kode status 500 untuk error server
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
