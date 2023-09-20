<?php

namespace App\Services;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;

class PostCommentService {
    public function __construct(
        private EntryService $entryService,
        private PostService $postService,
    ) {}

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function createPostComment(User $user, CommentRequest $commentRequest): Comment
    {
        $entry = $this->entryService->getPostEntry($commentRequest->entryId);

        if ($entry === null) {
            throw new StatamicEntryNotFoundException();
        }

        $post = $this->postService->findOrCreatePost($commentRequest->entryId);
        $post->save();

        /** @var Comment */
        return $post->comments()->create([
            'body'    => $commentRequest->body,
            'user_id' => $user
        ]);
    }
}
