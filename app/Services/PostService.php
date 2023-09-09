<?php

namespace App\Services;

use Statamic\Entries\EntryCollection;

class PostService
{
    public function __construct(
        private CommentService $commentService,
        private EntryService $entryService
    ) {}

    public function getRandomizedPostCollection($amount = 9): EntryCollection
    {
        return $this->entryService->getPostEntries()->random($amount);
    }

    public function getPostWithComments(string $entryId): array
    {
        $entry = $this->entryService->getPostEntry($entryId);

        $comments = $this->commentService->getCommentsByEntryId($entry->id);

        return [
            'entryId'        => $entry->id,
            'title'          => $entry->title,
            'body'           => $entry->body,
            'headerImageUrl' => $entry->header_image?->url,
            'tags'           => $entry->tags,
            'comments'       => $comments
        ];
    }
}

