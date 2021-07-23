<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

function setActiveRoute($name)
{
    return request()->routeIs($name) ? 'nav-link active' : 'nav-link';
}


function paginateCollection($items, $perPage = 15, $page = null)
{
    $pageName = 'page';
    $page = $page ?: (Paginator::resolveCurrentPage($pageName) ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);

    return new LengthAwarePaginator(
        $items->forPage($page, $perPage)->values(),
        $items->count(),
        $perPage,
        $page,
        [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]
    );
}
