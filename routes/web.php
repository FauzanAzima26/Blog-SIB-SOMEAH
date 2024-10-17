<?php

use App\Http\Controllers\categoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/serverside', [categoryController::class, 'getData'])->name('serverside');
