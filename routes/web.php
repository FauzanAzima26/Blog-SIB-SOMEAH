<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\categoryController;

Route::get('/', function () {
    return view('index');
});

Route::get('/serverside', [categoryController::class, 'getData'])->name('serverside');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
