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
    return redirect()->route('posts.index');
});

Route::get('/login', [PageController::class, 'login'])->name('security.login');
Route::get('/register', [PageController::class, 'register'])->name('security.register');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/comments', [CommentController::class, 'index']);

Route::get('/about', [GlobalSetController::class, 'about']);

Route::get('/user', function (Request $request) {
    if ($request->user()) {
        return new UserResource($request->user());
    }

    return null;
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store']);
});
