<?php

namespace App\Http\Controllers\backend;

use App\Charts\MonthlyUsersChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(MonthlyUsersChart $chart)
    {
        return view('backend.dashboard.index', [
            'chart' => $chart->build(),
        ]);
    }
}
