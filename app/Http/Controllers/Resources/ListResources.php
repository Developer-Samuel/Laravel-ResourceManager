<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\ResourceType;

class ListResources extends Controller
{
    public function __invoke(string $collectionName, ?int $userId = null)
    {
        $resourceType = ResourceType::where('collection_name', $collectionName)->first();

        if ($resourceType && $collectionName === 'users') {
            return DB::table('users')
                ->leftJoin('projects', 'users.id', '=', 'projects.user_id')
                ->select('users.*', DB::raw('COUNT(projects.id) as projects_count'))
                ->groupBy('users.id')
                ->get();
        }

        if ($resourceType && $collectionName === 'projects') {
            $query = DB::table('projects');
            if ($userId) {
                $query->where('user_id', $userId);
            }
            return $query->get();
        }

        return collect();
    }
}
