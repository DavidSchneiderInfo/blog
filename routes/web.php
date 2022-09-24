<?php

use App\Http\Controllers\Backend\Posts\CreatePostsController;
use App\Http\Controllers\Backend\Posts\DeletePostController;
use App\Http\Controllers\Backend\Posts\EditPostController;
use App\Http\Controllers\Backend\Posts\PreviewPostController;
use App\Http\Controllers\Backend\Posts\ShowPostListController;
use App\Http\Controllers\Backend\Posts\StorePostController;
use App\Http\Controllers\Backend\Posts\UpdatePostController;
use App\Http\Controllers\HomeController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function () {

    Route::get(RouteServiceProvider::HOME, [HomeController::class, 'index'])->name('home');

    Route::prefix(RouteServiceProvider::BACKEND)->group(function () {

        Route::get('posts', ShowPostListController::class)->name('backend.posts.index');
        Route::get('posts/create', CreatePostsController::class)->name('backend.posts.create');
        Route::post('posts', StorePostController::class)->name('backend.posts.store');
        Route::get('posts/{post}', PreviewPostController::class)->name('backend.posts.preview');
        Route::get('posts/{post}/edit', EditPostController::class)->name('backend.posts.edit');
        Route::put('posts/{post}', UpdatePostController::class)->name('backend.posts.update');
        Route::delete('posts/{post}', DeletePostController::class)->name('backend.posts.delete');
    });
});
