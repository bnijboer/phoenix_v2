<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $post = Post::whereUuid($request->postUuid)->first();
            $comments = $post->comments;
        } catch (\ErrorException $e) {
            $comments = [];
        }

        return $comments;
    }

    public function store(Request $request, CommentRequest $commentRequest)
    {
//        dd(Auth::user());

        $post = Post::firstOrCreate(['uuid' => $request->postUuid]);

        $user = User::find(1);

        return $user->comments()->create([
            'body' => $commentRequest->body,
            'post_id' => $post->id
        ]);
    }
}
