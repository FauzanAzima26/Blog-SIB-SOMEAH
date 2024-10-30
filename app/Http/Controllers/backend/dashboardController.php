<?php

namespace App\Http\Controllers\backend;

use App\Charts\articleChart;
use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function index(articleChart $chart)
    {
        return view('backend.dashboard.index', [
            'chart' => $chart->build(),
        ]);
    }
}
