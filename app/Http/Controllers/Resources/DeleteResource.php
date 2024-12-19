<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ResourceType;

class DeleteResource extends Controller
{
    public function __invoke(Request $request, string $collectionName)
    {
        $id = $request->input('id');

        $record = DB::table($collectionName)->where('id', $id)->first();

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => ucfirst($collectionName) . ' not found!',
            ], 404);
        }

        $resourceType = ResourceType::where('collection_name', $collectionName)->first();

        if (!$resourceType) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid resource type!',
            ], 400);
        }

        DB::table($collectionName)->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => ucfirst($collectionName) . ' deleted successfully!',
        ], 200);
    }
}
