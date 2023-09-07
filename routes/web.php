<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GlobalSetController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
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


Route::get('/', function () {
    return redirect()->route('pages.index');
});

Route::get('/login',             [PageController::class, 'loginPage'])         ->name('pages.login');
Route::get('/register',          [PageController::class, 'registerPage'])      ->name('pages.register');
Route::get('/posts',             [PageController::class, 'indexPage'])         ->name('pages.index');

Route::post('/posts/{entryId}/update-reader-count',      [PostController::class, 'updatePost'])        ->name('posts.update-reader-count');
Route::get('/posts/suggestions', [PostController::class, 'getPostSuggestions'])->name('posts.suggestions');

Route::get('/posts/{entryId}',        [PageController::class, 'showPage'])          ->name('pages.show');

Route::get('/comments',          [CommentController::class, 'index'])          ->name('comments.index');

Route::get('/about',             [GlobalSetController::class, 'about'])        ->name('sets.about');

Route::get('/user', function (Request $request) {
    if ($request->user()) {
        return new UserResource($request->user());
    }

    return null;
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});
