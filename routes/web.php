<?php

use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\GlobalSetController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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


Route::permanentRedirect('/', '/posts');

Route::get('/login',             [PageController::class, 'loginPage'])         ->name('pages.login');
Route::get('/register',          [PageController::class, 'registerPage'])      ->name('pages.register');
Route::get('/posts',             [PageController::class, 'indexPage'])         ->name('pages.index');

Route::post('/posts/{entryId}/update-reader-count',      [PostController::class, 'updatePost'])        ->name('posts.update_reader_count');
Route::get('/posts/suggestions', [PostController::class, 'getPostSuggestions'])->name('posts.suggestions');

Route::get('/posts/{entryId}',        [PageController::class, 'showPage'])          ->name('pages.show');

Route::get('/comments',          [PostCommentController::class, 'index'])          ->name('comments.index');

Route::get('/about',             [GlobalSetController::class, 'about'])        ->name('sets.about');

Route::middleware(['auth:sanctum'])->group(function () {
//    Route::get('/user', fn (Request $request) => $request->user() ? new UserResource($request->user()) : null);
    Route::post('/posts/{entryId}/comments', [PostCommentController::class, 'store'])->name('comments.store');
});
