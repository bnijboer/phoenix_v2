<?php

namespace App\Services;

use Statamic\Entries\EntryCollection;
use Statamic\Facades\Entry;

class EntryService
{
    public function getPostEntries(): EntryCollection
    {
        return Entry::whereInCollection(['blog']);
    }

    public function getPostEntry(string $entryId): mixed
    {
        return $this->getPostEntries()->firstOrFail(
            function ($entry) use ($entryId) {
                return $entry->id === $entryId;
            }
        );
    }
}

