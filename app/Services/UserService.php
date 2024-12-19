<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Http\Controllers\Resources\StoreResource;

class UserService
{
    private static string $collectionName = 'users';

    public static function update(Request $request, StoreResource $resource)
    {
        return $resource($request, self::$collectionName);
    }
}
