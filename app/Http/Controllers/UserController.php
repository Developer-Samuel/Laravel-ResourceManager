<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Http\Controllers\Resources\ShowResource;
use App\Http\Controllers\Resources\StoreResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function fetchData()
    {
        $user = Auth::user();

        return response()->json($user);
    }
    public function show(ShowResource $resource)
    {
        $user = $resource('users');

        if (!$user) {
            return redirect('/login');
        }
        return Inertia::render('Profile/Show', [
            'user' => $user,
        ]);
    }

    public function edit(ShowResource $resource)
    {
        $user = $resource('users');

        if (!$user) {
            return redirect('/login');
        }

        return Inertia::render('Profile/Edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, StoreResource $resource)
    {
        try {
            $response = UserService::update($request, $resource);
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
