<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tagController;
use App\Http\Controllers\backend\categoryController;

Route::prefix('admin')->middleware(['auth'])->group(function () {

    // category
    Route::resource('category', categoryController::class)->names('admin.category')
        ->except(['create', 'edit']);
    Route::get('serverside', [categoryController::class, 'getData'])->name('admin.category.serverside');

    // tag
    Route::resource('tag', tagController::class)->names('admin.tag')
    ->except(['create', 'edit']);
    Route::get('tag-serverside', [tagController::class, 'getData'])->name('admin.tag.serverside');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');