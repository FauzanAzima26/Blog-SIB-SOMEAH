<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\categoryController;

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::resource('category', categoryController::class)->names('admin.category')
    ->except(['create', 'edit']);
    Route::get('/serverside', [categoryController::class, 'getData'])->name('serverside');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');