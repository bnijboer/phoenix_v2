<?php

namespace App\Services;

use App\Events\PostCommented;
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
    public function createPostComment(
        string $entryId,
        User $user,
        CommentRequest $commentRequest
    ): Comment {
        $entry = $this->entryService->getPostEntry($entryId);

        if ($entry === null) {
            throw new StatamicEntryNotFoundException();
        }

        Post::firstOrCreate([
            'entry_id' => $entryId
        ]);

        /** @var Comment $comment */
        $comment = $user->comments()->create([
            'body'    => $commentRequest->body,
            'entry_id' => $entryId
        ]);

        PostCommented::dispatch($comment);

        return $comment;
    }
}
