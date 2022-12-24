<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;
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

        return CommentResource::collection($comments);
    }

    public function store(Request $request, CommentRequest $commentRequest)
    {
        $post = Post::firstOrCreate(['uuid' => $request->postUuid]);

        $comment = Auth::user()->comments()->create([
            'body' => $commentRequest->body,
            'post_id' => $post->id
        ]);

        return new CommentResource($comment);
    }
}
