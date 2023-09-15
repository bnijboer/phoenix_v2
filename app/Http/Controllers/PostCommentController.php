<?php

namespace App\Http\Controllers;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\PostCommentService;
use Symfony\Component\HttpFoundation\Request;

class PostCommentController extends Controller
{
    public function __construct(
        private PostCommentService $postCommentService
    ) {}

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function store(Request $request, CommentRequest $commentRequest): CommentResource
    {
        $comment = $this->postCommentService->createPostComment(
            $request->user(),
            $commentRequest
        );

        return new CommentResource($comment);
    }
}
