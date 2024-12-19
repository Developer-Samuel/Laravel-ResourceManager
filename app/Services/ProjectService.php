<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Http\Controllers\Resources\StoreResource;
use App\Http\Controllers\Resources\DeleteResource;

class ProjectService
{
    private static string $collectionName = 'projects';

    public static function store(Request $request, StoreResource $resource)
    {
        return $resource($request, self::$collectionName);
    }

    public static function update(Request $request, StoreResource $resource, $id)
    {
        return $resource($request, self::$collectionName, $id);
    }

    public static function delete(Request $request, DeleteResource $resource)
    {
        return $resource($request, self::$collectionName);
    }
}
