<?php

namespace App\Services;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class PostCommentService {
    public function __construct(
        private EntryService $entryService,
    ) {}

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function createPostComment(User $user, CommentRequest $commentRequest): Comment
    {
        $entry = $this->entryService->getPostEntry($commentRequest->get('entryId'));

        if ($entry === null) {
            throw new StatamicEntryNotFoundException();
        }

        $post = Post::firstOrCreate($commentRequest->get('entryId'));

        /** @var Comment */
        return $post->comments()->create([
            'body'    => $commentRequest->get('body'),
            'user_id' => $user
        ]);
    }
}
