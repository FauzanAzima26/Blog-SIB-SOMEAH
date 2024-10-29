<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\tagController;
use App\Http\Controllers\frontend\homeController;
use App\Http\Controllers\backend\writerController;
use App\Http\Controllers\backend\articleController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\frontend\sitemapController;
use App\Http\Controllers\frontend\tagController as frontendTagController;
use App\Http\Controllers\frontend\articleController as frontendArticleController;
use App\Http\Controllers\frontend\categoryController as frontendCategoryController;

Route::prefix('admin')->middleware('auth')->group(function () {

    // dashboard
    Route::get('dashboard', function () {
        return view('home');
    })->name('admin.dashboard');

    // category
    Route::resource('category', categoryController::class)->names('admin.category')
        ->except(['create', 'edit']);
    Route::get('serverside', [categoryController::class, 'getData'])->name('admin.category.serverside');
    Route::post('category/import', [categoryController::class, 'import'])->name('admin.category.import');

    // tag
    Route::resource('tag', tagController::class)->names('admin.tag')
    ->except(['create', 'edit']);
    Route::get('tag-serverside', [tagController::class, 'getData'])->name('admin.tag.serverside');

    // article
    Route::resource('article', articleController::class)->names('admin.article');
    Route::get('article-serverside', [articleController::class, 'getData'])->name('admin.article.serverside');
    Route::post('article/confirm', [articleController::class, 'updateConfirmation'])->name('admin.article.confirm');
    Route::get('restore/{uuid}', [articleController::class, 'restore'])->name('admin.article.restore');
    Route::delete('article/force-delete/{uuid}', [articleController::class, 'forceDelete']);

    // writer
    Route::get('writer-serverside', [writerController::class, 'getData'])->name('admin.writer.serverside');
    Route::resource('writer', writerController::class)->names('admin.writer');
});

Auth::routes();

Route::get('/', [homeController::class, 'index'])->name('frontend.home');

// Frontend Article
Route::get('article/search', [frontendArticleController::class, 'index'])->name('frontend.article.search');
Route::resource('article', frontendArticleController::class)
    ->only('index', 'show')
    ->names('article');

Route::resource('category', frontendCategoryController::class)
->only('index', 'show')
->names('category');

Route::get('tag/{slug}', [frontendTagController::class, 'showByTag'])->name('frontend.tag');

Route::get('sitemap.xml', [sitemapController::class, 'index'])->name('sitemap');