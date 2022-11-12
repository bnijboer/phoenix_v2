<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $post = Post::whereUuid($request->postUuid)->first();

        return $post->comments;
    }

    public function store(Request $request)
    {
        $post = Post::firstOrNew(['uuid' => $request->postUuid]);

        $post->save();

        return $post;
    }
}
