<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Auth\AdminSessionController;
use App\Http\Controllers\Admin\ArticleWorkflowController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/pencarian', [SearchController::class, 'index'])->name('search.index');
Route::get('/halaman/{slug}', [PageController::class, 'show'])->name('pages.show');


Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminSessionController::class, 'create'])->name('login');
    Route::post('/admin/login', [AdminSessionController::class, 'store'])->name('login.store');
});

Route::post('/admin/logout', [AdminSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('articles', AdminArticleController::class);
    Route::post('articles/{article}/submit-review', [ArticleWorkflowController::class, 'submitReview'])->name('articles.submit-review');
    Route::post('articles/{article}/approve', [ArticleWorkflowController::class, 'approve'])->name('articles.approve');
    Route::post('articles/{article}/schedule', [ArticleWorkflowController::class, 'schedule'])->name('articles.schedule');
    Route::post('articles/{article}/publish', [ArticleWorkflowController::class, 'publish'])->name('articles.publish');

    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('tags', AdminTagController::class)->except(['show']);
    Route::resource('media', AdminMediaController::class)->only(['index', 'store', 'destroy']);
    Route::resource('pages', AdminPageController::class)->only(['index', 'edit', 'update']);
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update']);

    Route::get('settings/general', [AdminSettingController::class, 'edit'])->name('settings.general.edit');
    Route::put('settings/general', [AdminSettingController::class, 'update'])->name('settings.general.update');
});
