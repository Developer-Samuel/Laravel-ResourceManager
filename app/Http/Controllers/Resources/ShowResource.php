<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\ResourceType;

class ShowResource extends Controller
{
    public function __invoke(string $collectionName, ?string $url = null)
    {
        $resourceType = ResourceType::where('collection_name', $collectionName)->first();

        $user = Auth::user();
        $userId = $user && $user->role === 'admin' ? null : Auth::id();

        if ($resourceType && $collectionName === 'users') {
            $query = DB::table('users')->where('id', $userId)->first();

            return $query;
        }

        if ($resourceType && $collectionName === 'projects') {
            $query = DB::table('projects')
                ->when($userId, function ($query, $userId) {
                    return $query->where('user_id', $userId);
                })
                ->where('url', $url)
                ->first();

            return $query;
        }

        return collect();
    }
}
