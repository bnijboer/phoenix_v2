<?php

namespace App\Http\Controllers;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function __construct(
        private CommentService $commentService
    ) {}

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function store(Request $request, CommentRequest $commentRequest): CommentResource
    {
        $comment = $this->commentService->createComment(
            $request->user(),
            $commentRequest
        );

        return new CommentResource($comment);
    }
}
