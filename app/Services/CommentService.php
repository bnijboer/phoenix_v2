<?php

namespace App\Services;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CommentService {
    public function __construct(
        private EntryService $entryService
    ) {}

    public function getCommentsByEntryId(string $entryId): Collection
    {
        return Comment::where('entry_id', $entryId)->get();
    }

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function createComment(User $user, CommentRequest $commentRequest): Comment
    {
        $entry = $this->entryService->getPostEntry($commentRequest->entryId);

        if ($entry === null) {
            throw new StatamicEntryNotFoundException();
        }

        $post = Post::firstOrCreate([
            'entry_id' => $commentRequest->entryId
        ]);

        /** @var Comment $comment */
        $comment = $user->comments()->create([
            'body'     => $commentRequest->body,
            'entry_id' => $post->entry_id,
        ]);

        return $comment;
    }
}
