<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuotationController;

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

/*
 * NEWS
 */
Route::prefix('news')
    ->name('news.')
    ->group(function () {
        Route::get('', [NewsController::class, 'index'])
            ->name('index');
        Route::get('slug/{slug?}', [NewsController::class, 'showBySlug'])
            ->name('showBySlug');
        Route::post('', [NewsController::class, 'store'])
            ->name('store');
        Route::get('{news}', [NewsController::class, 'show'])
            ->name('show');
        Route::get('{news}/edit', [NewsController::class, 'edit'])
            ->name('edit');
        Route::put('{news}/edit', [NewsController::class, 'update'])
            ->name('update');
        Route::delete('{news}/destroy', [NewsController::class, 'destroy'])
            ->name('destroy');
    });

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/like', [LikeController::class, 'like'])->name('like');

Route::delete('/comments/{commentId}/unlike', [LikeController::class, 'unlikeComment'])->name('comment.unlike');

Route::get('/likes/{contentId}', [LikeController::class, 'countLikes'])->name('count.likes');

Route::post('/comment/{commentId}/like', [CommentController::class, 'like'])->name('comment.like');

Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
Route::get('/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
Route::get('/quotations/{quotation}', [QuotationController::class, 'show'])->name('quotations.show');
Route::get('/quotations/{quotation}/edit', [QuotationController::class, 'edit'])->name('quotations.edit');
Route::put('/quotations/{quotation}', [QuotationController::class, 'update'])->name('quotations.update');
Route::delete('/quotations/{quotation}', [QuotationController::class, 'destroy'])->name('quotations.destroy');
