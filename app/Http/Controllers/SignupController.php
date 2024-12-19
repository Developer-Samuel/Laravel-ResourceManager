<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Controllers\Resources\StoreResource;
use App\Services\AuthService;

class SignupController extends Controller
{
    public function show()
    {
        return Inertia::render('Auth/Signup');
    }

    public function store(Request $request, StoreResource $resource)
    {
        try {
            $response = AuthService::signup($request, $resource);

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
