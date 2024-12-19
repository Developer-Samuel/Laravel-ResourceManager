<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Resources\ListResources;
use App\Http\Controllers\Resources\CreateResource;
use App\Http\Controllers\Resources\StoreResource;
use App\Http\Controllers\Resources\ShowResource;
use App\Http\Controllers\Resources\DeleteResource;
use App\Services\ProjectService;

use App\Enums\Status;

class ProjectController extends Controller
{
    public function list(ListResources $resource)
    {
        $role = Auth::user()->role;

        if($role == 'user') {
            $userId = Auth::id();
        } else {
            $userId = null;
        }

        $projects = $resource('projects', $userId);

        return Inertia::render('Projects/List', [
            'projects' => $projects,
            'role' => $role
        ]);
    }

    public function show(ShowResource $resource, $url)
    {
        $project = $resource('projects', null, $url);

        if (!$project) {
            return redirect('/login');
        }
        return Inertia::render('Projects/Show', [
            'project' => $project,
        ]);
    }

    public function create(CreateResource $resource)
    {
        return $resource('projects');
    }

    public function store(Request $request, StoreResource $resource)
    {
        try {
            $response = ProjectService::store($request, $resource);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $statusCode);
        }
    }

    public function edit(ShowResource $resource, $url)
    {
        $project = $resource('projects', $url);

        if (!$project) {
            return redirect('/projects');
        }

        $statuses = Status::getStatusOptions();

        return Inertia::render('Projects/Edit', [
            'project' => $project,
            'statuses' => $statuses
        ]);
    }

    public function update(Request $request, StoreResource $resource, $id)
    {
        try {
            $response = ProjectService::update($request, $resource, $id);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $statusCode);
        }
    }

    public function delete(Request $request, DeleteResource $resource)
    {
        try {
            $response = ProjectService::delete($request, $resource);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $statusCode);
        }
    }
}
