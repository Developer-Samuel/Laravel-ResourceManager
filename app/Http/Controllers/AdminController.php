<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use App\Http\Controllers\Resources\ListResources;

class AdminController extends Controller
{
    public function users(ListResources $resource)
    {
        $users = $resource('users');

        return Inertia::render('Admin/Users', [
            'users' => $users,
        ]);
    }

    public function projects(ListResources $resource, $userId)
    {
        $projects = $resource('projects', $userId);

        return Inertia::render('Admin/Projects', [
            'projects' => $projects,
        ]);
    }
}
