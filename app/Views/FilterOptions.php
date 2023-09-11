<?php

namespace App\Views;

class FilterOptions
{
    public function __construct(
        public int $page,
        public int $limit,
        public int $offset,
        public string $orderBy,
        public string $orderDirection,
        public ?string $tag = null
    ) {}
}
