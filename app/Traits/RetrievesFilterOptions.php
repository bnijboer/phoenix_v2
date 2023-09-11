<?php

namespace App\Traits;

use App\Views\FilterOptions;
use Symfony\Component\HttpFoundation\Request;

trait RetrievesFilterOptions
{
    public function getFilterOptions(Request $request): FilterOptions
    {
        return new FilterOptions(
            (int)$request->get('page', 1),
            (int)$request->get('limit', 10),
            (int)$request->get('offset', 0),
            $request->get('orderBy', 'date'),
            $request->get('orderDirection', 'desc'),
            $request->get('tag'),
        );
    }
}
