<?php

namespace App\Services;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Views\FilterOptions;
use Statamic\Contracts\Entries\QueryBuilder;
use Statamic\Extensions\Pagination\LengthAwarePaginator;
use Statamic\Entries\Entry as PostEntry;
use Statamic\Facades\Entry;
use Statamic\Stache\Query\EntryQueryBuilder;

class EntryService
{
    public function getPaginatedPostEntries(FilterOptions $filterOptions): LengthAwarePaginator
    {
        $queryBuilder = $this->postEntries();

        if ($filterOptions->tag) {
            $queryBuilder->whereJsonContains('tags', $filterOptions->tag);
        }

        return $queryBuilder
            ->orderBy($filterOptions->orderBy, $filterOptions->orderDirection)
            ->paginate($filterOptions->limit);
    }

    public function getPostEntry(string $entryId): PostEntry|null
    {
        return $this->postEntries()->find($entryId);
    }

    public function postEntries(): QueryBuilder|EntryQueryBuilder
    {
        return Entry::query()->where('collection', 'blog');
    }
}

