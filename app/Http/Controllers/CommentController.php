<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, CommentRequest $commentRequest)
    {
        $comment = Auth::user()->comments()->create([
            'body' => $commentRequest->body,
            'post_id' => $commentRequest->postId
        ]);

        return new CommentResource($comment);
    }
}
