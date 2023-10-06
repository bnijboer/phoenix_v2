<?php

use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\GlobalSetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
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

/* Redirects */
Route::permanentRedirect('/', '/posts');

/* Posts */
Route::get('/posts', [PostController::class, 'indexPage'])->name('posts.index');
Route::post('/posts/{entryId}/update-reader-count', [PostController::class, 'updatePost'])->name('posts.update_reader_count');
Route::get('/posts/suggestions', [PostController::class, 'getPostSuggestions'])->name('posts.suggestions');
Route::get('/posts/{entryId}', [PostController::class, 'showPage'])->name('posts.show');

/* Comments */
Route::get('/comments', [PostCommentController::class, 'index'])->name('comments.index');

/* Subscriptions */
Route::post('/subscriptions/preferences', [SubscriptionController::class, 'savePreferences'])->name('subscriptions.save_preferences');


/* Global sets */
Route::get('/about', [GlobalSetController::class, 'about'])->name('globals.about');

/* Guarded */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/posts/{entryId}/comments', [PostCommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
