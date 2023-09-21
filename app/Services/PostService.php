<?php

namespace App\Services;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Models\Post;
use App\Views\FilterOptions;
use Statamic\Entries\Entry;
use Statamic\Entries\EntryCollection;
use Statamic\Extensions\Pagination\LengthAwarePaginator;

class PostService
{
    public function __construct(
        private EntryService $entryService
    ) {}

    public function getPaginatedPosts(FilterOptions $filterOptions): LengthAwarePaginator
    {
        return $this->entryService->getPaginatedPostEntries($filterOptions);
    }

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function getPost(string $entryId): Entry
    {
        $post = $this->entryService->getPostEntry($entryId);

        if ($post === null) {
            throw new StatamicEntryNotFoundException();
        }

        return $post;
    }

    public function updatePostReaderCount(string $entryId): Post
    {
        return Post::firstOrNew([
            'entry_id' => $entryId
        ])->increment('reader_count');
    }

    public function getRandomizedPostCollection($amount = 9): EntryCollection
    {
        return $this->entryService->postEntries()->get()->random($amount);
    }
}
