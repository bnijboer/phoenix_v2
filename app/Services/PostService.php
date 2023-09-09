<?php

namespace App\Services;

use Statamic\Entries\EntryCollection;
use Statamic\Entries\Entry;

class PostService
{
    public function __construct(
        private EntryService $entryService
    ) {}

    public function getRandomizedPostCollection($amount = 9): EntryCollection
    {
        return $this->entryService->getPostEntries()->random($amount);
    }

    public function getPost(string $entryId): Entry
    {
        return $this->entryService->getPostEntry($entryId);
    }
}
