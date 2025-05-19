<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;

function locales()
{
    $locales = LaravelLocalization::getSupportedLocales();
    return collect($locales)->map(function ($locale) {
        return $locale['name'];
    });
}

function filterDataTable($items, $resource, Request $request, $relations = [])
{
    $pagination = $request->pagination;
    $items = $items->with($relations);

    if ($pagination['perpage'] == -1 || $pagination['perpage'] == null) {
        $pagination['perpage'] = 10;
    }
    $itemsCount = $items->count();
    $items = $items->take($pagination['perpage'])->skip($pagination['perpage'] * ($pagination['page'] - 1))->get();
    $pagination['total'] = $itemsCount;
    $pagination['pages'] = ceil($itemsCount / $pagination['perpage']);
    $data['meta'] = $pagination;
    $data['data'] = $resource->collection($items);
    return $data;
}
