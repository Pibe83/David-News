<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');

Route::get('news/{slug}', [NewsController::class, 'showBySlug'])->name('news.show');

Route::get('/news/{slug?}', [NewsController::class, 'index'])->name('news.index');

Route::delete('/news/{slug}', [NewsController::class, 'destroy'])->name('news.destroy');

Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');

Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/like', [LikeController::class, 'like'])->name('like');

Route::delete('/comments/{commentId}/unlike', [LikeController::class, 'unlikeComment'])->name('comment.unlike');

Route::get('/likes/{contentId}', [LikeController::class, 'countLikes'])->name('count.likes');

Route::post('/comment/{commentId}/like', [CommentController::class, 'like'])->name('comment.like');
